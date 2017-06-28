<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Post;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    /**
     *  @ApiDoc(
     *  resource=true,
     *  section="Posts",
     *  description="Retrieve comments for specified post.",
     *  requirements={
     *      {
     *          "name"="slug",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="The post slug for which you want to retrieve the comments"
     *      }
     *  },
     *  statusCodes={
     *      200 = "OK",
     *      404 = "Not Found",
     *      405 = "Method Not Allowed"
     *  }
     *  )
     * @Rest\Get("/post/comments/{slug}")
     * @View(serializerGroups={"Default"})
     */
    public function getPostCommentsAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findOneBy(['slug' => $slug]);

        if (!$post instanceof Post) {
            throw new NotFoundHttpException('Post not found');
        }

        return $post->getComments();
    }

}
