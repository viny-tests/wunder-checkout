<?php
declare(strict_types=1);

namespace App\UI\Controller\Actions;

use App\Application\Write\SaveAddressInfoCommand;
use App\Domain\Address;
use App\Domain\CustomerRepository;
use App\UI\Form\Type\AddressInfoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/{id}/address", name="save_address_info", methods={"POST"})
 */
class SaveAddressToCustomer extends AbstractController
{
    public function __construct(private CustomerRepository $repository)
    {
    }

    public function __invoke(Request $request, string $id): RedirectResponse
    {
        $customer = $this->repository->retrieve($id);

        $form = $this->createForm(AddressInfoType::class, new SaveAddressInfoCommand());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SaveAddressInfoCommand $event */
            $event = $form->getData();

            $customer->setAddressInfo(new Address($event->street, $event->houseNumber, $event->zipCode, $event->city));

            $this->repository->save($customer);

            return $this->redirectToRoute('payment_info', ['id' => $customer->getId()]);
        }

        return $this->redirectToRoute('home');
    }
}
