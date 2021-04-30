<?php
// src/Controller/DefaultController2Controller.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\SecurityUser;
use App\Entity\Address;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ServiceInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Events\VideoCreatedEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;
use App\Form\VideoFormType;
use App\Form\RegisterUserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;



class DefaultController2Controller extends AbstractController
{
    public function __construct(EventDispatcherInterface $dispatcher)
    {

        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("/event", name="event")
     */
    public function index(Request $request,TranslatorInterface $translator)
    {
        // $entityManager = $this->getDoctrine()->getManager();
        $translated = $translator->trans('Symfony jest super');
        dump($translated);
        $video = new \stdClass();

        $video->title = 'Funny movie';
        $video->category = 'funny';

        $event = new VideoCreatedEvent($video);
        $this->dispatcher->dispatch($event, 'video.created.event');

        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/form", name="form")
     */
    public function form(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
       // $video = $entityManager->getRepository(Video::class)->find(1);
       # dump($videos);
        $video = new Video();
        //$video->setTitle('Video title');
        //$video->setCreatedAt(new \DateTime('tomorrow'));
        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid())
        {
            //dump($form->getData());
           // return ($this->redirectToRoute('event'));
            $file = $form->get('file')->getData();
            $filename = sha1(random_bytes(14)).'.'.$file->guessExtension();
            $file->move($this->getParameter('videos_directory'), $filename);
            dump($form->getData());
            $entityManager->persist($video);
            $entityManager->flush();
            return ($this->redirectToRoute('form'));
        }
        return $this->render('displayForm.html.twig', [
            'controller_name' => 'DefaultController',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/mail", name="mail")
     */
    public function mail(Request $request, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('slavuflorina@yahoo.com')
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',
                    array('name'=>'Florina')
                ),
                'text/html'
            );
        $mailer->send($message);
        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);
        $user = new SecurityUser();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $user->setPassword( $passwordEncoder->encodePassword($user, $form->get('password')->getData()));
            $user->setEmail($form->get('email')->getData());
            //$user->setRole($user, $form->get('role')->getData());
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('default_controller2/index.html.twig', [
            'controller_name' => 'DefaultController2Controller',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    // @Security("has_role('ROLE_ADMIN')")
    /**
     * @Route("/deleteVideo/{id}/delete-video", name="deleteVideo")
     * @Security("user.getId() == video.getSecurityUser().getId()")
     */
    public function deleteVideo(Request $request, UserPasswordEncoderInterface $passwordEncoder, Video $video)
    {
      //  $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository(Video::class)->find(1);
      //  dump($users);
        dump($video);
        $this->denyAccessUnlessGranted('VIDEO_DELETE', $video);
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }

}
