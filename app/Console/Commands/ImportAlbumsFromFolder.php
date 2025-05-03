<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DiscogsService;
use App\Models\Album;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportAlbumsFromFolder extends Command
{
    protected $signature = 'albums:import-from-folder {folder=E:\Mamusique}';
    protected $description = 'Importe les albums depuis un dossier local en utilisant le code-barres et l\'API Discogs';

    public function handle(DiscogsService $discogsService)
    {
        $folder = $this->argument('folder');
        $directories = File::directories($folder);
        $i=0;
        foreach ($directories as $dir) {
            $discIniPath = $dir . DIRECTORY_SEPARATOR . 'disc.ini';
            if (File::exists($discIniPath)) {
                $content = File::get($discIniPath);
                if (preg_match('/Label=(\\d+)/', $content, $matches)) {
                    $barcode = $matches[1];
                    $this->info("Traitement du code-barres : " . $barcode);

                    // SAUTER SI DEJA PRESENT
                    
                if (Album::where('barcode', $barcode)->exists()) {
                    $i++;
                    $this->info($i . " &#x1F4E2; Album déjà importé pour le code-barres : " . $barcode . ". Passage au suivant.");
                    continue;
                }

                    $result = $discogsService->searchAlbumByBarcode($barcode);

                    if (!empty($result['results'][0])) {
                        $discogsAlbum = $result['results'][0];

                        $discogsAlbumByID = $discogsService->searchAlbumById($discogsAlbum['id']);
                
                        Album::updateOrCreate(
                            ['barcode' => $barcode],
                            [
                                'title' => mb_substr($discogsAlbum['title'], 0, 240),
                                'artist' => $discogsAlbumByID['artists'][0]['name'] ?? null,
                                'repertory' => \Illuminate\Support\Str::after($dir, $folder . '\\'),
                                'discogs_id' => $discogsAlbum['id'] ?? null,
                                'raw_discogs' => json_encode($discogsAlbumByID)
                            ]
                        );
                        $this->info("Album importé : ". $discogsAlbum['title']);
                    } else {
                        Album::updateOrCreate(
                            ['barcode' => $barcode],
                            [
                                'title' => null,
                                'artist' => null,
                                'repertory' => \Illuminate\Support\Str::after($dir, $folder . '\\'),
                                'discogs_id' => null,
                                'raw_discogs' => null
                            ]
                        );
                        $this->warn("Aucun album trouvé pour le code-barres : ". $barcode);
                    }
                } else {
                    $this->warn("Aucun code-barres trouvé dans ".$discIniPath);
                }
            }
            sleep(2);
        }

        $this->info('Import terminé.');
    }
}