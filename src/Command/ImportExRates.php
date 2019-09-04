<?php


namespace App\Command;

use App\Entity\ExRates;
use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportExRates extends ContainerAwareCommand
{
    protected static $defaultName = 'app:exrates-import';
    private $entityManager;
    private $doctrine;
    private $day = 7;

    protected function configure()
    {


    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->doctrine = $this->getContainer()->get('doctrine');
        $this->entityManager = $this->doctrine->getEntityManager();
        $this->clearExRates();
        for ($period = $this->day; $period != 0; $period--) {
            $date = new \DateTime();
            $date->modify('-' . $period . ' day');
            $this->saveExRates(new SimpleXMLElement($this->getExRates($date)), $date);
        }
        $output->writeln('База в актуальном состоянии!');
    }

    protected function saveExRates(SimpleXMLElement $xml, $date)
    {

        foreach ($xml as $item) {
            $exRates = new ExRates();
            $repository = $this->doctrine->getRepository(ExRates::class);
            $rate = $repository->findOneBy([
                'numCode' => (int)$item->NumCode,
                'date' => $date,
            ]);
            if (empty($rate)) {
                $exRates->setNumCode((int)$item->NumCode);
                $exRates->setCharCode($item->CharCode);
                $exRates->setScale((float)$item->Scale);
                $exRates->setName($item->Name);
                $exRates->setRate((float)$item->Rate);
                $exRates->setDate($date);
                $this->entityManager->persist($exRates);
                $this->entityManager->flush();
            }
        }
    }

    protected function getExRates($date)
    {
        $ch = curl_init();
        $url = "http://www.nbrb.by/Services/XmlExRates.aspx?onDate=" . $date->format('m/d/Y');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0); // читать заголовок
        curl_setopt($ch, CURLOPT_NOBODY, 0); // читать ТОЛЬКО заголовок без тела
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $XMLData = curl_exec($ch);
        curl_close($ch);
        return $XMLData;
    }

    protected function clearExRates()
    {
        $conn = $this->entityManager->getConnection();
        $sql = '
        DELETE FROM ex_rates
        WHERE date > :date
        ';
        $stmt = $conn->prepare($sql);
        $dateSim = new \DateTime('now');
        $dateSim->modify('-' . $this->day . ' day');
        $stmt->execute(['date' => $dateSim->format('m/d/Y')]);
    }

}