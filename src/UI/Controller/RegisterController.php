<?php
declare(strict_types=1);

namespace App\UI\Controller;

use App\Domain\Customer;
use App\Domain\CustomerRepository;
use App\UI\Form\Type\AddressInfoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    public function __construct(private CustomerRepository $repository)
    {
    }

    /**
     * @Route(path="/", name="personal_info", methods={"GET"})
     */
    public function personalInfo(): Response
    {
        return $this->render(
            'register/personalInfo.html.twig',
            [
                'form' => $this->createForm(AddressInfoType::class)->createView(),
            ]
        );
    }

    /**
     * @Route(path="/{id}/address", name="address_info", methods={"GET"})
     */
    public function addressInfo(string $id): Response
    {
        $customer = $this->repository->retrieve($id);

        return $this->render('register/addressInfo.html.twig',
            [
                'form' => $this->createForm(AddressInfoType::class, ['customerId' => $customer->getId()])->createView(),
            ]
        );
    }

    /**
     * @Route(path="/{id}/payment", name="payment_info", methods={"GET"})
     */
    public function paymentInfo(Customer $customer): Response
    {
        return $this->render('register/paymentInfo.html.twig');
    }

    /**
     * @Route(path="/{id}/feedback", name="final_step", methods={"GET"})
     */
    public function feedback(Customer $customer): Response
    {
        return $this->render('register/feedback.html.twig');
    }
}
