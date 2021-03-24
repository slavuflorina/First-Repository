<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Pdf;
use App\Services\ServiceInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Author;
use App\Entity\File;
use App\Services\MyService;
use App\Services\mMSecondService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;


class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
       // exit($request->query->get('page','home'));
        if(!$users)
        {
            throw($this->createNotFoundException('The users do not exist!'));
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users'=>$users
        ]);
    }

    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */

    public function generate_url()
    {
        exit($this->generateURL('generate_url',
            array('param'=>10),
        UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }

    /**
     * @Route("/download", name="download")
     */
    public function download()
    {
        $path=$this->getParameter('download_directory');
        return $this->file($path.'wd.pdf');
    }

    /**
     * @Route("/redirect-test", name="redirectTest")
     */
    public function redirectTest()
    {
	    return $this->redirectToRoute('urlToRedirect',array('param'=>10));
    }
    /**
     * @Route("url-to-redirect/{param?}", name="urlToRedirect")
     */
    public function urlToRedirect()
    {
        exit('Redirect Test');
    }
    /**
     * @Route("forward-to-controller", name="forwardToController")
     */
    public function forwardToController()
    {
        $response = $this->forward('App\Controller\DefaultController::index');
        return $response;
    }

    public function mostPopularPosts($number = 3)
    {
        // database call:
        $posts = ['post 1', 'post 2', 'posts 3', 'posts 4'];
        return $this->render('default/mostPopularPosts.html.twig', [
            'posts' => $posts,
        ]);
    }
    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setName('Florina1');
        $entityManager->persist($user);
        $entityManager->flush();
       // dump("Id:".$user->getId());
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }

    /**
     * @Route("/find", name="find")
     */
    public function find(){
        $repository = $this->getDoctrine()->getRepository(User::class);
       // $user = $repository->find(7);
        //$user = $repository->findOneBy(['id' => '7']);
        $user = $repository->findAll();
        dump($user);
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/edit", name="edit")
     */
    public function edit(){
        $entityManager = $this->getDoctrine()->getManager();
        // $user = $repository->find(7);
        $user = $entityManager->getRepository(User::class)->find(['id' => '7']);
        //$user = $repository->findAll();
        dump($user);
        if(!$user)
        {
            throw($this->createNotFoundException('The user do not exist!'));
        }
        $user->setName('Florina');
       // $repository->persist($user);
        $entityManager->flush();
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/delete", name="delete")
     */
    public function delete(){
        $entityManager = $this->getDoctrine()->getManager();
        // $user = $repository->find(7);
        $user = $entityManager->getRepository(User::class)->find(['id' => '8']);
        //$user = $repository->findAll();
        dump($user);
        if(!$user)
        {
            throw($this->createNotFoundException('The user do not exist!'));
        }
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/rawquery", name="rawquery")
     */
    public function rawquery(){
        $entityManager = $this->getDoctrine()->getManager();
        $conn  =$entityManager->getConnection();
        $sql = 'SELECT * FROM user u WHERE u.id >:id';
        $smtp = $conn->prepare($sql);
        $smtp->execute(['id'=>9]);
        dump($smtp->fetchAll());
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/paramconverter/{id}", name="paramconverter")
     */
    public function paramconverter(Request $request, User $user){
       // $entityManager = $this->getDoctrine()->getManager();
       dump($user);
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/videos", name="videos")
     */
    public function videos(Request $request){
         $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setName('Florina');
        for($i=1;$i<=3;$i++)
        {
            $video = new Video();
            $video->setTitle('Title for video '. $i);
            $user->addVideo($video);
            $entityManager->persist($video);

        }
        $entityManager->persist($user);
        $entityManager->flush();
        dump('Created video with ID: '.$video->getId());
        $video = $this->getDoctrine() ->getRepository(Video::class)->find(1);
        dump($video->getUser()->getName());
        $user = $this->getDoctrine() ->getRepository(User::class)->find(7);
        foreach($user->getVideos() as $video)
        {
            dump($video->getTitle());
        }
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/deleteVideos", name="deleteVideos")
     */
    public function deleteVideos(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine() ->getRepository(User::class)->find(1);
        $entityManager->remove($user);
        $entityManager->flush();
        dump($user);
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/address", name="address")
     */
    public function address(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setName('Florina');
        $address = new Address();
        $address->setStreet('Inginerilor Tei');
        $address->setNumber('6');
        $user->setAdress($address);
        $entityManager->persist($user);
        $entityManager->persist($address);
        dump($user->getAdress()->getStreet());
        $entityManager->flush();
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/selfRelation", name="selfRelation")
     */
    public function selfRelation(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        /*for($i=1;$i<=4;$i++)
        {
            $user = new User();
            $user->setName('Florina '.$i);

            $entityManager->persist($user);
        }

        $entityManager->flush(); */
        $user1 = $this->getDoctrine() ->getRepository(User::class)->find(1);
        $user2 = $this->getDoctrine() ->getRepository(User::class)->find(2);
        $user3 = $this->getDoctrine() ->getRepository(User::class)->find(3);
        $user4 = $this->getDoctrine() ->getRepository(User::class)->find(4);
        $user1->addFollowed($user2);
        $user1->addFollowed($user3);
        $user1->addFollowed($user4);
        $entityManager->flush();
        dump($user1->getFollowed()->count());
        dump($user2->getFollowed()->count());
        dump($user3->getFollowed()->count());
        dump($user4->getFollowed()->count());
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/polymorphism", name="polymorphism")
     */
    public function polymorphism(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
       // $items = $entityManager->getRepository(File::class)->findAll();
       // dump($items);
       /* $author = $entityManager->getRepository(Author::class)->find(6);
        foreach($author->getFiles() as $file)
        {
            if($file instanceof Pdf) //afiseaza doar pdf urile care apartin autorului cu id 6
                  dump($file->getFilename());
        } */

        $author = $entityManager->getRepository(Author::class)->findByIdWithPdf(6);
        foreach($author->getFiles() as $file)
        {

                dump($file->getFilename());
        }
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/myService", name="myService")
     */
    public function myService(Request $request, ServiceInterface $service)
    {
        #Parametru:  MyService $service, ContainerInterface $container
        #$service->someAction();
        #dump($service->secService->someMethod());
        #$entityManager = $this->getDoctrine()->getManager();
      #  $user = $entityManager->getRepository(User::class)->find(25);
      #  $user->setName('Florina');
      #  $entityManager->persist($user);
      #  $entityManager->flush();
       # dump($container->get('app.myservice'));
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/cache", name="cache")
     */
    public function cache(Request $request)
    {
        $cache = new FilesystemAdapter();
        $posts = $cache->getItem('database.get_posts');
        if(!$posts->isHit())
        {
            $posts_from_db = ['post1', 'post2', 'post3'];
            dump('connected');
            $posts->set(serialize($posts_from_db));
            $posts->expiresAfter(5);
            $cache->save($posts);
        }
        $cache->clear();
        dump(unserialize($posts->get()));
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
    /**
     * @Route("/cachetag", name="cachetag")
     */
    public function cachetag(Request $request)
    {
        $cache = new TagAwareAdapter(
            new FilesystemAdapter()
        );

        $acer = $cache->getItem('acer');
        $dell = $cache->getItem('dell');
        if(!$acer->isHit())
        {
            $acer_from_db = 'acer laptop';
            $acer->set($acer_from_db);
            $acer->tag(['acer', 'laptop', 'computer']);
            $acer->expiresAfter(5);
            $cache->save($acer);
            dump('Acer from db');
        }
        if(!$dell->isHit())
        {
            $dell_from_db = 'acer laptop';
            $dell->set($dell_from_db);
            $dell->tag(['dell', 'laptop', 'computer']);
            $dell->expiresAfter(5);
            $cache->save($dell);
            $cache->save($dell);
            dump('Acer from db');
        }
        dump($acer->get());
        dump($dell->get());
        return $this->render('subview.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }
}
