<?=$this->Form->create(null, array('url'=>['controller'=>'Users', 'action'=>'login']));
echo $this->Form->control('email', [
    'label' => "Username",
    'required' => "true",
    'placeholder' => "username",
    'class' => "form-control"
]);
echo $this->Form->control('password', [
    'label' => "Password",
    'required' => "true",
    'placeholder' => "password",
    'class' => "form-control"
]);
echo $this->Form->button('login');
echo $this->Form->end();
