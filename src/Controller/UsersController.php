<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Controlador de Usuarios
 *
 * Este controlador gestiona las acciones relacionadas con los usuarios, como
 * mostrar, agregar, editar y eliminar usuarios, así como el inicio y cierre
 * de sesión.
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Método Index
     *
     * Muestra una lista paginada de usuarios.
     *
     * @return \Cake\Http\Response|null|void Renderiza la vista
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * Método Ver
     *
     * Muestra los detalles de un usuario específico.
     *
     * @param string|null $id Id del usuario
     * @return \Cake\Http\Response|null|void Renderiza la vista
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Cuando no se encuentra el registro.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bookmarks'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Método Agregar
     *
     * Permite agregar un nuevo usuario.
     *
     * @return \Cake\Http\Response|null|void Redirige al agregar exitoso, renderiza la vista en otro caso.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser guardado. Por favor, intente de nuevo.'));
        }
        $this->set(compact('user'));
    }

    // Otros métodos de editar y eliminar usuarios...

    /**
     * Método de inicio de sesión
     *
     * Permite a los usuarios iniciar sesión en la aplicación.
     */
    public function login()
    {
        if ($this->request->is('post')) 
        {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Tu usuario o contraseña es incorrecta.');
        }
    }
    
    /**
     * Inicializar el controlador
     *
     * Configura la autenticación para permitir ciertas acciones sin autenticación.
     */
    public function initialize(): void
    {
        parent::initialize();

        // Permitir acciones sin autenticación
        $this->Auth->allow(['logout', 'add']);
    }

    /**
     * Método de cierre de sesión
     *
     * Permite a los usuarios cerrar sesión en la aplicación.
     */
    public function logout()
    {
        $this->Flash->success('Has cerrado sesión.');
        return $this->redirect($this->Auth->logout());
    }  
}
