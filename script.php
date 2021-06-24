#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

use Payment\Client\ClientRepository;
use Payment\Currency\CurrencyRepository;
use Payment\Operation\OperationRepository;
use Payment\Money\Money;
use Payment\Processor;

(new SingleCommandApplication())
    ->setName('Paysera Command') // Optional
    ->setVersion('1.0.0') // Optional
    ->addArgument('csv', InputArgument::REQUIRED, 'Input CSV file')
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
            while (($inputRow = fgetcsv($inputHandler, 1000)) !== FALSE)
            {
                try {
                    $csvRow = array_combine($header, $inputRow);

                    $client = ClientRepository::get(intval($csvRow['user_id']), $csvRow['user_type']);
                    $currency = CurrencyRepository::get(strtoupper($csvRow['currency']));
                    $amount = new Money($csvRow['oper_amount'], $currency);
                    $operation = OperationRepository::create(
                        $client, 
                        $csvRow['oper_type'],
                        $amount,
                        new \DateTime($csvRow['date']),
                    );
                    $client->addOperation($operation);
                   
                    Processor::process($operation);
                    echo $operation->getComission()->roundUp() . "\n";
                } catch (Exception $e) {
                    fwrite(STDERR, sprintf("[%s] %s\n", get_class($e), $e->getMessage()));
                }
            }
            fclose($inputHandler);
        }
    })
    ->run();