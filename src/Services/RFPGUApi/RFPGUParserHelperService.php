<?php


namespace App\Services\RFPGUApi;


use App\Repository\LecturerRepository;
use App\Repository\UserRepository;
use App\Utils\LecturerStringUtils;
use Doctrine\ORM\EntityManagerInterface;

class RFPGUParserHelperService implements ParserHelperInterface
{
    const URL_LECTURERS = '/page.php';

    private $listLecturers = [
        '   Тягульская Людмила Анатольевна    ',
        'Козак Людмила Ярославовна  ',
        'Балан Лилия Александровна   ',
        'Борсуковский Сергей Иванович',
        'Глазов Анатолий Борисович',
        'Ляху Александр Анатольевич',
        'Сташкова Ольга Витальевна',
        'Шестопал Оксана Викторовна',
        'Гарбузняк Елена Сергеевна',
        'Кардаш Людмила Федоровна',
        'Нагаевский Октавиан Михайлович',
        'Нагаевская Наталья Владимировна',
        'Борсуковсий Сергей Васильевич',
        'Станьковская Алена Александровна',
        'Луценко Игорь Владимирович       ',
        'Пешкин Дана Ильинична  ',
    ];

    private $urlsLecturers = [
        '218',
        '219',
        '221',
        '222',
        '236',
        '224',
        '225',
        '226',
        '227',
        '228',
        '229',
        '232',
        '315',
        '234',
        '235',
        '284',
    ];

    private $entityManager;

    private $lecturerRepository;

    private $pguParserService;

    private $userRepository;


    public function __construct(
        EntityManagerInterface $entityManager,
        LecturerRepository $lecturerRepository,
        ParserInterface $pguParserService,
        UserRepository $userRepository
    )
    {
        $this->entityManager       = $entityManager;
        $this->lecturerRepository  = $lecturerRepository;
        $this->pguParserService    = $pguParserService;
        $this->userRepository      = $userRepository;
    }


    public function getLecturerPublicationText($lecturer)//this method for get data of the publications a lecturer
    {
        return $this->pguParserService->getUrlData(self::URL_LECTURERS, 'GET', ['query' => $lecturer['url']]);
    }

    private function setLecturerPublicationText($lecturer, $text) //saved all lecturers to the database by name,surname,patronymic and set their text
    {

        $userWithLecturer = $this->userRepository->findOneBy(
            [
                'name' => $lecturer['name'],
                'surname' => $lecturer['surname'],
                'patronymic' => $lecturer['patronymic']
            ]
        );
        $foundLecturer = $userWithLecturer ? $userWithLecturer->getLecturer():null;
        if($foundLecturer) {
            $foundLecturer->setPublicationsText($text);
            $this->entityManager->persist($foundLecturer);
            $this->entityManager->flush();
            return $foundLecturer;
        }

        return false;
    }

    private function fillLecturersPublicationText() // don't need to explain
    {
        $lecturers = [];

        foreach ($this->listLecturers as $lecturerNumber => $sourceLecturer) {
            $lecturer = LecturerStringUtils::fullName($sourceLecturer);
            $lecturer = array_merge($lecturer,['url' => $this->urlsLecturers[$lecturerNumber]]);

            $text = $this->getLecturerPublicationText($lecturer);
            if($text === false) { // If we didn't have lecturer with the publications, this situation is possible
//                $fullData = implode(' ', $lecturer);
               // throw new HttpException(400, "Can't find al least one correspond text to: $fullData");
            }

//            $savedLecturer = $this->setLecturerPublicationText($lecturer, $text);
//            if($savedLecturer === false) {
//                $fullData = implode(' ', $lecturer);
//                throw new HttpException(400, "Unable to save the lecturer: $fullData");
//            }

            $lecturers[] = $text;
        }

        return $lecturers;
    }

    public function initialize()
    {
        return $this->fillLecturersPublicationText();
    }
}
