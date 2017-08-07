<?php
App::uses('AppController', 'Controller');
/**
 * Writers Controller
 *
 * @property Writer $Writer
 * @property PaginatorComponent $Paginator
 */
class WritersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * menu method
 *
 * @return void
 */
	public function menu() {
		if($this->request->is('requested')){
			$writers = $this->Writer->find('all',[
			/*'recursive' => -1,*/
			'order' => ['name'=>'asc']
			]);
		return $writers;
		}		
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = array(
				'fields'=>array('name','slug'),
				'order'=> array('name'=>'desc'),
				'limit' => 5,
				'paramType' => 'querystring'
			);
		$writers = $this->paginate();
		$this->set('writers',$writers);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug = null) {
		$options = array(
			'conditions' => array('Writer.slug'=> $slug),
			'recursive' => -1
			);
		$writer = $this->Writer->find('first', $options);
		//echo debug($writer);
		if (empty($writer)) {
			throw new NotFoundException(__('Không tìm thấy tác giả này'));
		}
		$this->set('writer', $writer);
		//phân trang dữ liệu book
		$this->paginate = array(
			'fields' => array('id','title','image','sale_price','slug'),
			'order' => array('created' => 'desc'),
			'limit' => 5,
			'contain' => array(
				'Writer' => array('name','slug'),
				),
			'joins' => array(
				array(
					'table' => 'books_writers',
					'alias' => 'BookWriter',
					'conditions' => 'BookWriter.book_id = Book.id'
					),
				array(
					'table' => 'writers',
					'alias' => 'Writer',
					'conditions' => 'BookWriter.writer_id = Writer.id'
					)
				),
			'conditions' => array(
				//'published' => 1,
				'Writer.slug' => $slug
				),
			'paramType' =>'querystring'
			);
		$books = $this->paginate('Book');
		$this->set('books',$books);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Writer->create();
			if ($this->Writer->save($this->request->data)) {
				$this->Flash->success(__('The writer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The writer could not be saved. Please, try again.'));
			}
		}
		$books = $this->Writer->Book->find('list');
		$this->set(compact('books'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Writer->exists($id)) {
			throw new NotFoundException(__('Invalid writer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Writer->save($this->request->data)) {
				$this->Flash->success(__('The writer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The writer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Writer.' . $this->Writer->primaryKey => $id));
			$this->request->data = $this->Writer->find('first', $options);
		}
		$books = $this->Writer->Book->find('list');
		$this->set(compact('books'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Writer->id = $id;
		if (!$this->Writer->exists()) {
			throw new NotFoundException(__('Invalid writer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Writer->delete()) {
			$this->Flash->success(__('The writer has been deleted.'));
		} else {
			$this->Flash->error(__('The writer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
