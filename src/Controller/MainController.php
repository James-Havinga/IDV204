<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Repository\ReplyRepository;
use Symfony\Component\Form\Form;
use App\Form\CommentType;
use App\Form\ReplyType;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Reply;

/**
 * @Route("/askio", name="index.")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/question", name="question")
     */
    public function index(QuestionRepository $questionRepository)
    {
        $featuredQuestions = $questionRepository->findBy([
            'featured' => true
        ]);

        $questions = $questionRepository->findBy([
            'featured' => false
        ]);

        return $this->render('main/index.html.twig', [
            'questions' => $questions,
            'featuredQuestions' => $featuredQuestions
        ]);
    }

    /**
     * @Route("/question/{id}", name="show")
     */
    public function show(Question $question, Request $req, ReplyRepository $replyRepo) {
        $question->getId();

        // Signed In user
        $user = $this->getUser();

        // Fetching Likes
        $likes = $question->getLikes();

        // Get all comments
        $comments = $question->getComments();

        // Get all replies
        $replies = $replyRepo->findBy([
            'question_id' => $question
        ]);

        // Comment Form 
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($req);

        //  Reply form
        $replyForm = $this->createForm(ReplyType::class);
        $replyForm->handleRequest($req);

        // Comment form 
        if ($form->isSubmitted()){
            // Getting Data from the Request
            $data = $form->getData();

            // Setting All the Data
            $comment = new Comment();
            $comment->setComment($data['comment']);
            $comment->setUser($user);
            $comment->setQuestion($question);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

        }

        return $this->render('main/show.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
            'likes' => $likes,
            'replies' => $replies,
            'comments' => $comments,
            'user' => $user
        ]);
    }

    // , methods={"POST"}
    /**
     * @Route("/comment/{id}/reply", name="reply")
     */
    public function reply (Request $req, Comment $cmt) {
        $user = $this->getUser();

        $cmt->getComment();
        $replyBody = $req->query->get('reply');
        $questionId = intval($req->query->get('questionId'));

        $reply = new Reply();
        $reply->setUser($user);
        $reply->setQuestionId($questionId);
        $reply->setReply($replyBody);
        $reply->setCom($cmt);

        $em = $this->getDoctrine()->getManager();
        $em->persist($reply);
        $em->flush();

        return $this->redirectToRoute('index.show', array(
            'id' => $questionId,
        ));
    }

    /**
     *@Route("/question/{id}/like", name="like")
     */
    public function likeQuestion (Question $question) {
        $likes = $question->getLikes() + 1;

        $question->setLikes($likes);

        $em = $this->getDoctrine()->getManager();
        $em->persist($question);
        $em->flush();

        return new JsonResponse(['likes' => $likes]);
    }
}
