<?php
namespace Passionweb\Webm\Command;

use Passionweb\Webm\Service\WebmConverterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class WebmConverterCommand extends Command
{
    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure()
    {
        $this->setDescription('Converts video files in queue into webM format');
    }

    /**
     * Executes the command for convertion of videos in queue
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        try {
            $io->writeln('Start convertion of videos in queue');

            $webMConverterService = GeneralUtility::makeInstance(WebmConverterService::class);
            $webMConverterService->processVideoQueue();

            $io->success('Convertion of videos in queue finished successfully');

            return Command::SUCCESS;
        } catch (Exception $e) {
            $logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
            $logger->error($e->getMessage());

            $io->error('Convertion of videos in queue failed with following output:');
            $io->writeln($e->getMessage());

            return Command::FAILURE;
        }
    }
}
