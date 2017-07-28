<?php namespace Anomaly\BoxAdapterExtension;

use Anomaly\BoxAdapterExtension\Command\LoadDisk;
use Anomaly\FilesModule\Disk\Adapter\AdapterExtension;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;

/**
 * Class BoxAdapterExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BoxAdapterExtension extends AdapterExtension
{

    /**
     * This module provides the s3
     * storage adapter for the files module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.files::adapter.box';

    /**
     * Load the disk.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk)
    {
        $this->dispatch(new LoadDisk($disk));
    }

    /**
     * Validate adapter configuration.
     *
     * @param array $configuration
     * @return bool
     */
    public function validate(array $configuration)
    {
        return true;
    }

}
