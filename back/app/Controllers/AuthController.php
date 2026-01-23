classAuthController {
publicfunctionsignup() {
$input =json_decode(file_get_contents("php://input"),true) ?? [];
$req =newSignupRequest($input);
$data =$req->validated();

$service =newAuthService(newUserRepository());
$user =$service->signup($data['email'],$data['password'],$data['name']);

returnJsonResponse::created(['user' =>$user]);
  }

publicfunctionlogin() {
$input =json_decode(file_get_contents("php://input"),true) ?? [];
$req =newLoginRequest($input);
$data =$req->validated();

$service =newAuthService(newUserRepository());
$result =$service->login($data['email'],$data['password']);

returnJsonResponse::ok($result);
  }
}

