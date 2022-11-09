<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;

use App\Entity\Location;

use App\Service\WeatherUtil;

#[AsCommand(
    name: 'weather:location-id',
    description: 'Add a short description for your command',
)]
class WeatherLocationIdCommand extends Command
{
    /*public function __construct(LocationRepository $locationRepository, MeasurementRepository $measurementRepository, string $name = null)
    {
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
        parent::__construct($name);
    }*/

    private WeatherUtil $weatherUtil;

    //public function __construct(WeatherUtil $weatherUtil, string $name = null)
    public function __construct(WeatherUtil $weatherUtil, LocationRepository $locationRepository, MeasurementRepository $measurementRepository, string $name = null )
    {
        $this->weatherUtil = $weatherUtil;
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
        //$this->location = $location;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('locationId', InputArgument::REQUIRED, 'Location to check')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /*$io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');*/

        $locationId = $input->getArgument('locationId');

        $result = $this->weatherUtil->getWeatherForLocation2($locationId);

        $output->writeln(json_encode($result, JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }
}
