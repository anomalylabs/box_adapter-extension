<?php namespace Anomaly\BoxAdapterExtension\Command;

use Anomaly\BoxAdapterExtension\Adapter\BoxAdapter;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Illuminate\Filesystem\FilesystemManager;
use League\Flysystem\MountManager;

/**
 * Class LoadDisk
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadDisk
{

    /**
     * The disk interface.
     *
     * @var DiskInterface
     */
    protected $disk;

    /**
     * Create a new LoadDisk instance.
     *
     * @param DiskInterface $disk
     */
    public function __construct(DiskInterface $disk)
    {
        $this->disk = $disk;
    }

    /**
     * @param ConfigurationRepositoryInterface $configuration
     */
    public function handle(
        ConfigurationRepositoryInterface $configuration,
        FilesystemManager $filesystem,
        MountManager $manager
    ) {

        $prefix = $configuration->value('anomaly.extension.box_adapter::prefix', $this->disk->getSlug(), true);

        /* @var EncryptedFieldTypePresenter $token */
        $token = $configuration->presenter('anomaly.extension.box_adapter::access_token', $this->disk->getSlug());

        $driver = new AdapterFilesystem(
            $this->disk,
            new BoxAdapter(
                $token->decrypt(),
                $prefix ? $this->disk->getSlug() : null
            )
        );

        $manager->mountFilesystem($this->disk->getSlug(), $driver);

        $filesystem->extend(
            $this->disk->getSlug(),
            function () use ($driver) {
                return $driver;
            }
        );
    }
}
