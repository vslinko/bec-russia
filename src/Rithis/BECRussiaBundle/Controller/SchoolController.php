<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Symfony\Component\HttpFoundation\Response;

use Sonata\MediaBundle\Model\MediaInterface;

use Rithis\BECRussiaBundle\Form\Type\SchoolCommentType,
    Rithis\BECRussiaBundle\Entity\School;

/**
 * @Route("/schools")
 */
class SchoolController extends BaseController
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function allAction()
    {
        return array(
            'schools' => $this->getRepository('School')->findForAllPageBlock($this->getSelectedTown()),
        );
    }

    /**
     * @Route("/{slug}")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function getAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/teachers/")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function teachersAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/discounts")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function discountsAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/contacts")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function contactsAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/news/")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function newsAction(School $school)
    {
        $this->saveLastSchool($school);

        $query = $this->getRepository('News')->createSchoolNewsQueryBuilder($school);

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10
        );

        return array('school' => $school, 'pagination' => $pagination);
    }

    /**
     * @Route("/{slug}/schedule")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function scheduleAction(School $school)
    {
        $this->saveLastSchool($school);
    }

    /**
     * @Route("/{slug}/comments/")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function commentsAction(School $school)
    {
        $this->saveLastSchool($school);

        return array(
            'school' => $school,
            'form' => $this->createForm(new SchoolCommentType())->createView(),
            'success' => $this->getRequest()->getSession()->getFlashBag()->get('online-request'),
        );
    }

    /**
     * @Route("/{slug}/comments/")
     * @Method("POST")
     * @Template("RithisBECRussiaBundle:School:comments.html.twig")
     */
    public function postCommentAction(School $school)
    {
        $form = $this->createForm(new SchoolCommentType());
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $comment = $form->getData();
            $comment->setSchool($school);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->getRequest()->getSession()->getFlashBag()->add('school-comment', true);

            return $this->redirect($this->generateUrl('rithis_becrussia_school_comments', array('slug' => $school->getSlug())));
        }

        return array('school' => $school, 'form' => $form->createView());
    }

    /**
     * @Route("/{slug}/galleries/")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function galleriesAction(School $school)
    {
        $this->saveLastSchool($school);

        $query = $this->getRepository('Gallery')->createSchoolQueryBuilder($school);
        
        if ($this->getRequest()->query->has('provider') && 'all' !== $this->getRequest()->query->get('provider')) {
            $provider = $this->getRequest()->query->get('provider');
            $query->andWhere('g.provider = :provider')
                ->setParameter('provider', 'sonata.media.provider.' . $provider);
        } else {
            $provider = 'all';
        }

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $this->getRequest()->query->get('page', 1),
            10
        );

        return array('school' => $school, 'pagination' => $pagination, 'provider' => $provider);
    }

    /**
     * @Route("/{slug}/galleries/{gallery}")
     * @Method("GET")
     */
    public function galleryAction(School $school, $gallery)
    {   //* @Cache(expires="+1 Week")
        $this->saveLastSchool($school);
        
        $gallery = $this->getRepository('Gallery')->findOneBy(array('slug' => $gallery));

        $medias = array();
        foreach ($gallery->getGalleryHasMedias() as $hasMedia) {
            switch ($hasMedia->getMedia()->getProviderName()) {
                case "sonata.media.provider.image":
                    $medias[] = $this->extractImage($hasMedia->getMedia());
                    break;
                case "sonata.media.provider.youtube":
                    $medias[] = $this->extractYoutube($hasMedia->getMedia());
                    break;
            }
        }
        $response = new Response(json_encode(array('items' => $medias)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function extractImage(MediaInterface $media)
    {
        $provider = $this->get('sonata.media.provider.image');
        $thumbnailFormat = $provider->getFormatName($media, 'small');
        $bigFormat = $provider->getFormatName($media, 'big');
        
        return array(
            'thumb' => $provider->generatePublicUrl($media, $thumbnailFormat),
            'image' => $provider->generatePublicUrl($media, $bigFormat),
            'big'   => $provider->generatePublicUrl($media, $bigFormat),
            'title' => $media->getName(),
            'description' => $media->getName(),
        );
    }

    public function extractYoutube(MediaInterface $media)
    {        
        return array(
            'video' => sprintf('http://www.youtube.com/watch?v=%s', $media->getProviderReference()),
            'title' => $media->getName(),
            'description' => $media->getName(),
        );
    }
}
