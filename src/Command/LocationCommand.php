<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'location:command',
    description: 'Add a short description for your command',
)]
class LocationCommand extends Command
{
    private WeatherUtil $weatherUtil;
    public function __construct(WeatherUtil $weatherUtil)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('id',null,InputOption::VALUE_REQUIRED,'ID');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $idOption = $input->getOption('id');

        if (!$idOption){
            $io->error("Need id");
            return -1;
        }

        $parsedId = ctype_digit($idOption) ? intval($idOption): null;
        if($parsedId===null){
            $io->error("Must be a number");
            return -1;
        }
        $results = $this->weatherUtil->getWeatherForLocation($parsedId);
        if(count($results)==0){
            $io->error("No results");
            return -1;
        }
        $data = array();
        foreach ($results as $result){
            $resu['id'] = $result->getId();
            $resu['temperature'] = $result->getTemperature();
            $resu['precipitation']= $result->getPrecipitation();
            $resu['humidity']=$result->getHumidity();
            $resu['uv_index']=$result->getUvIndex();
            $resu['wind_speed']=$result->getWindSpeed();
            $resu['wind_direction']=$result->getWindDirection();
            $resu['date'] = $result->getDate();
            array_push($data,$resu);







        }
        $output->writeln(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        $io->success('succ');

        return Command::SUCCESS;
    }
}
