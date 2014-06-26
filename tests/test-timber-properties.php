<?php
	
	class TimberPropertyTest extends WP_UnitTestCase {

		function testPropertyID(){
			$post_id = $this->factory->post->create();
			$user_id = $this->factory->user->create();
			$comment_id = $this->factory->comment->create(array('comment_post_ID' => $post_id));
			$term_id = wp_insert_term('baseball', 'post_tag');
			$term_id = $term_id['term_id'];
			$post = new TimberPost($post_id);
			$user = new TimberUser($user_id);
			$term = new TimberTerm($term_id);
			$comment = new TimberComment($comment_id);
			$this->assertEquals($post_id, $post->ID);
			$this->assertEquals($post_id, $post->id);
			$this->assertEquals($user_id, $user->ID);
			$this->assertEquals($user_id, $user->id);
			$this->assertEquals($term_id, $term->ID);
			$this->assertEquals($term_id, $term->id);
			$this->assertEquals($comment_id, $comment->ID);
			$this->assertEquals($comment_id, $comment->id);
		}


		function _initObjects(){
			$post_id = $this->factory->post->create();
			$user_id = $this->factory->user->create();
			$comment_id = $this->factory->comment->create(array('comment_post_ID' => $post_id));
			$term_id = wp_insert_term('baseball', 'post_tag');
			$term_id = $term_id['term_id'];
			$post = new TimberPost($post_id);
			$user = new TimberUser($user_id);
			$term = new TimberTerm($term_id);
			$comment = new TimberComment($comment_id);
			return array('post' => $post, 'user' => $user, 'term' => $term, 'comment' => $comment);
		}

		function testMeta(){
			$vars = $this->_initObjects();
			extract($vars);
			$post->update('thomas', 'jefferson');
			$term->update('abraham', 'lincoln');
			$user->update('dwight', 'einsenhower');
			$user->update('teddy', 'roosevelt');
			$user->update('john', 'kennedy');
			$comment->update('george', 'washington');
			$this->assertEquals('jefferson', $post->thomas);
			$this->assertEquals('lincoln', $term->abraham);
			$this->assertEquals('roosevelt', $user->teddy);
			$this->assertEquals('washington', $comment->george);
		}

	}