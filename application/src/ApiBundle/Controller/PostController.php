<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Post;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  section="Posts",
     *  description="Retrieve last 10 posts.",
     *  statusCodes={
     *      200 = "OK",
     *      405 = "Method Not Allowed"
     *  }
     *  )
     * @View(serializerGroups={"Default"})
     * @Rest\Get("/posts")
     */
    public function getPostsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatestX(10);

        return $posts;
    }

    /**
     *  @ApiDoc(
     *  resource=true,
     *  section="Posts",
     *  description="Retrieve latest posts by page number.",
     *  requirements={
     *      {
     *          "name"="page",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="The page from which you want yo retrieve the posts"
     *      }
     *  },
     *  statusCodes={
     *      200 = "OK",
     *      404 = "Not Found",
     *      405 = "Method Not Allowed"
     *  }
     *  )
     * @View(serializerGroups={"Default"})
     * @Rest\Get("/posts/{page}", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function getPostsByPageAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findLatestByPage($page);

        return $posts;
    }

    /**
     *  @ApiDoc(
     *  resource=true,
     *  section="Posts",
     *  description="Retrieve details for specified post.",
     *  requirements={
     *      {
     *          "name"="slug",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="The post slug for which you want to retrieve the details"
     *      }
     *  },
     *  statusCodes={
     *      200 = "OK",
     *      404 = "Not Found",
     *      405 = "Method Not Allowed"
     *  }
     *  )
     * @Rest\Get("/post/{slug}")
     * @View(serializerGroups={"Default","Details"})
     */
    public function getPostAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findOneBy(['slug' => $slug]);

        if (!$post instanceof Post) {
            throw new NotFoundHttpException('Post not found');
        }

        return $post;
    }

}
