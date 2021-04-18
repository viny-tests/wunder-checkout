<?php
declare(strict_types=1);

namespace App\UI\Controller\Actions;

use App\Application\Write\SavePersonalInfoCommand;
use App\Domain\Customer;
use App\Domain\CustomerRepository;
use App\UI\Form\Type\AddressInfoType;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="save_personal_info", methods={"POST"})
 */
class CreateCustomer extends AbstractController
{
    public function __construct(private CustomerRepository $repository)
    {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $form = $this->createForm(AddressInfoType::class, new SavePersonalInfoCommand(Uuid::uuid4()->toString()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SavePersonalInfoCommand $event */
            $event = $form->getData();

            $customer = new Customer($event->uuid, $event->firstName, $event->lastName, $event->telephone);

            $this->repository->save($customer);

            return $this->redirectToRoute('address_info', ['id' => $customer->getId()]);
        }

        return $this->redirectToRoute('home');
    }
}
