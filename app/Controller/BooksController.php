<?php
App::uses('AppController', 'Controller');
/**
 * Books Controller
 *
 * @property Book $Book
 * @property PaginatorComponent $Paginator
 */
class BooksController extends AppController {

	// public $paginate = array(
	// 	'order' => array('created' => 'desc'),
	// 	'limit' => 5
	// 	);

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 * hiển thị 10 quyển sách mới nhất trên trang chủ
 *
 * @return void
 */

	public function index() {
		//$this->Book->recursive = 0;
		//$this->set('books', $this->Paginator->paginate());

		$books = $this->Book->latest();
		$this->set('books',$books);
	}

/**
 * latest_books method
 * hiển thị tất cả quyển sách và sắp xếp từ mới đến cũ
 * phân trang dữ liệu
 *
 * @return void
 */

	public function latest_books() {
		$this->paginate = array(
			'fields' => array('id','title','image','sale_price','slug'),
			'order' => array('created' => 'desc'),
			'limit' => 7,
			'contain' => array(
				'Writer' => array('name','slug')),
			//'conditions' => array('published' => 1),
			'paramType' =>'querystring'
			);
		$books = $this->paginate();
		$this->set('books',$books);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug = null) {
		$options = array('conditions' => array('Book.slug' => $slug),
			'contain' => array('Writer'=> array('name','slug'))
			);
		$book = $this->Book->find('first', $options); //$option là giá trị tùy chọn của hàm find
		//pr($book);
		if (empty($book)) {
			throw new NotFoundException(__('Không tìm thấy quyển sách này'));
		}		
		$this->set('book', $book);
		//hiển thi comments
		$this->loadModel('Comment');
		$comments = $this->Comment->find('all',array(
			'conditions' => array(
				'book_id' => $book['Book']['id']
				),
			'order' => array('Comment.created'=>'asc'),
			'contain' => array('User'=>'username')
			));
		//pr($comments);
		$this->set('comments',$comments);
		//hiển thị sách liên quan
		$related_books = $this->Book->find('all',array(
			'fields'=> array('title','image','sale_price','slug'),
			'conditions' => array(
				'category_id' => $book['Book']['category_id'],
				'Book.id <>' => $book['Book']['id'],
				//'published' => 1
				),
			'contain' => array('Writer'=>array('name','slug')),
			'limit' => 5,
			'order' => 'rand()'
			));
		//pr($related_books);
		$this->set('related_books',$related_books);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Book->create();
			if ($this->Book->save($this->request->data)) {
				$this->Flash->success(__('The book has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The book could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Book->Category->find('list');
		$writers = $this->Book->Writer->find('list');
		$this->set(compact('categories', 'writers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Invalid book'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Book->save($this->request->data)) {
				$this->Flash->success(__('The book has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The book could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
			$this->request->data = $this->Book->find('first', $options);
		}
		$categories = $this->Book->Category->find('list');
		$writers = $this->Book->Writer->find('list');
		$this->set(compact('categories', 'writers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Book->id = $id;
		if (!$this->Book->exists()) {
			throw new NotFoundException(__('Invalid book'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Book->delete()) {
			$this->Flash->success(__('The book has been deleted.'));
		} else {
			$this->Flash->error(__('The book could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function truyvan(){
		$books = $this->Book->find('first',array(
			'fields' => array('id','title'),
			//'recursive' => -1
			'contain' => array(
				'Writer' => array('fields' => array('id','name')),
				'Comment' => array('limit' => 1))
			));
		pr($books);
		exit;
	}


	/*Hàm xử lí get_keyword*/

	public function get_keyword(){
		if ($this->request->is('post')) {
			$this->Book->set($this->request->data);
			if ($this->Book->validates()) {
				$keyword = $this->request->data['Book']['keyword'];
			}else{
				$errors = $this->Book->validationErrors;
				$this->Session->writer('search_validation',$errors);
			}
			$this->redirect(['action'=>'search','keyword'=>$keyword]);
		}
	}

	/*Tìm kiếm sách*/

	public function search(){
		$notfound = false;
		if (!empty($this->request->params['named']['keyword'])) {
			$keyword = $this->request->params['named']['keyword'];
				$this->paginate = [
					'fields'=>['title','image','sale_price','slug'],
					'contain' => ['Writer.name','Writer.slug'],
					'limit' => 5,
					'order' => ['Book.created' => 'desc'],
					'conditions' => [
						'Book.published' => 1,
						'or'=>[
							'title like' => '%'.$keyword.'%',
							'Writer.name like' => '%'.$keyword.'%']
					],
					'joins' => [
						[
							'table' => 'books_writers',
							'alias' => 'BookWriter',
							'conditions' => 'BookWriter.book_id = Book.id'
						],
						[
							'table' => 'writers',
							'alias' => 'Writer',
							'conditions' => 'BookWriter.writer_id = Writer.id'
						]
					]
					];
				$books = $this->paginate('Book');
				//$books = $this->Book->find('all');
				//pr($books);
				if(!empty($books)){
					$this->set('results',$books);
				}else{
					$notfound = true;
				}
				$this->set('keyword',$keyword);
		}

		if($this->Session->check('search_validation')){
			$this->set('errors',$this->Session->read('search_validation'));
		}				
		$this->set('notfound',$notfound);
	}

	/*public function update_comment(){
		$books = $this->Book->find('all',[
			'fields' =>'id',
			'contain' =>'Comment'
			]);
		//pr($books);
		foreach ($books as $book) {
			//echo count($book['Comment']).'<br>';
			if (count($book['Comment'])>0) {
				$this->Book->updateAll(
					['comment_count'=>count($book['Comment'])],
					['Book.id'=>$book['Book']['id']]
					);
			}
		}
	}*/


}
