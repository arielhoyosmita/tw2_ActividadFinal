<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tags Controller
 *
 * Controlador de Etiquetas
 *
 * @property \App\Model\Table\TagsTable $Tags
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
{
    /**
     * Index method
     *
     * Método de índice
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Obtiene y pagine las etiquetas
        $tags = $this->paginate($this->Tags);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * Método de vista
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Obtiene una etiqueta y sus marcadores asociados
        $tag = $this->Tags->get($id, [
            'contain' => ['Bookmarks'],
        ]);

        $this->set(compact('tag'));
    }

    /**
     * Add method
     *
     * Método de agregar
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEmptyEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $bookmarks = $this->Tags->Bookmarks->find('list', ['limit' => 200])->all();
        $this->set(compact('tag', 'bookmarks'));
    }

    // Otros métodos de editar y eliminar etiquetas...

    /**
     * Inicializar el controlador
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Método de cierre de sesión
     *
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
