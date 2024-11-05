<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:cron',
    description: 'Add a short description for your command',
)]
class CronCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Writes current timestamp into public/cron');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = __DIR__ . '/../../public/cron';

        try {
            // Get current timestamp
            $timestamp = (new \DateTime())->format('Y-m-d H:i:s');

            // Write the timestamp into the file
            if (file_put_contents($filePath, $timestamp) !== false) {
                $io->success('Timestamp written successfully.');
            } else {
                $io->error('Failed to write timestamp to the file.');
                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $io->error('An error occurred: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
