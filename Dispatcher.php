<?php


use Interfaces\IGrabber;
use Interfaces\ILogger;
use Interfaces\IOutput;

class Dispatcher
{

	/**
	 * @var IGrabber
	 */
	private $grabber;
	/**
	 * @var IOutput
	 */
	private $output;
    /**
     * @var ILogger
     */
    private $logger;

    /**
	 * @param IGrabber $grabber
	 * @param IOutput $output
	 */
	public function __construct(IGrabber $grabber, IOutput $output, ILogger $logger)
	{
		$this->grabber = $grabber;
		$this->output = $output;
        $this->logger = $logger;
    }

	/**
	 * @return string JSON
	 */
	public function run()
	{
	    try {
            $file = $this->getFile();
            $codes = $this->getCodesFromContent($file);
            $result = [];
            foreach ($codes as $code){
                if(empty($code)){
                    continue;
                }
                $this->grabber->findProduct($code);
                $result[$code] = [
                    'price' => $this->grabber->getPrice()
                ];
            }
            $this->output->setContent($result);
            $this->output->getJson();
        } catch (\Throwable $e) {
	        $this->logger->log($e->getMessage(), ILogger::ERROR);
	        echo $e->getMessage();
        }
	}

    /**
     * @return string
     * @throws ErrorException
     */
    private function getFile(): string
    {
        if(!$file = file_get_contents(__DIR__ . '\vstup.txt')){
            throw new ErrorException("File error, file maybe doesn't exists!");
        }
        return $file;
    }

    private function getCodesFromContent(string $content): array
    {
        return explode(PHP_EOL, $content) ?? [];
    }

}
