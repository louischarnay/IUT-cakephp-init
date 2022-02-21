<?=$this->Form->create(null, array('url'=>['controller'=>'Users', 'action'=>'signin']));
echo $this->Form->control('email', [
    'label' => "Username",
    'required' => "true",
    'placeholder' => "Username"
]);
echo $this->Form->control('password', [
    'label' => "Password",
    'required' => "true",
    'placeholder' => "Password"
]);
echo $this->Form->control('password', [
    'label' => "Confirm password",
    'required' => "true",
    'placeholder' => "password"
]);
echo $this->Form->button('register');
echo $this->Form->end();
