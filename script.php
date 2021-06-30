#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

use Payment\Repository\ClientRepository;
use Payment\Repository\CurrencyRepository;
use Payment\Entity\Money\Money;
use Payment\Service\OperationService;
use Payment\Service\CurrencyService;

(new SingleCommandApplication())
    ->setName('Paysera Command') // Optional
    ->setVersion('1.0.0') // Optional
    ->addArgument('csv', InputArgument::REQUIRED, 'Input CSV file')
    ->addArgument('test', InputArgument::OPTIONAL, 'Use test Currencies')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $inputFileName = $input->getArgument('csv');
        if (($inputHandler = fopen($inputFileName, 'r')) !== FALSE)
        {
            $header = [
                'date',
                'user_id',
                'user_type',
                'oper_type',
                'oper_amount',
                'currency'
            ];
            $currencies = json_decode(file_get_contents('currency.json'), true);
            CurrencyService::init($currencies, $input->getArgument('test')=='test');
            while (($inputRow = fgetcsv($inputHandler, 1000)) !== FALSE)
            {
                try {
                    $csvRow = array_combine($header, $inputRow);

                    $client = ClientRepository::get(intval($csvRow['user_id']), $csvRow['user_type']);
                    $currency = CurrencyRepository::get(strtoupper($csvRow['currency']));
                    $amount = new Money(floatval($csvRow['oper_amount']), $currency);
                    $operation = OperationService::create(
                        $client, 
                        $csvRow['oper_type'],
                        $amount,
                        new \DateTime($csvRow['date']),
                    );
                   
                    OperationService::process($operation);
                    echo $operation->getComission()->roundUp() . "\n";
                } catch (Exception $e) {
                    fwrite(STDERR, sprintf("[%s] %s\n", get_class($e), $e->getMessage()));
                }
            }
            fclose($inputHandler);
        }
    })
    ->run();