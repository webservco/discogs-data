<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractReleasesProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    public function start()
    {
    }

    /*
    * @param mixed $data
    * @return bool
    */
    public function processItem($data)
    {
        ++ $this->totalItems;
        /* */
        var_dump($data->getAttribute('id')); //XXX
        var_dump($data->getAttribute('status')); //XXX
        //var_dump($data); //XXX
        echo PHP_EOL; //XXX
        exit; //XXX XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
        /* */
    }

    public function finish()
    {
    }
}
