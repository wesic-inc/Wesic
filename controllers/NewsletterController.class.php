<?php
class newsletterController
{
    public function successAction(Request $request)
    {
        dd($request);
        // $v = new View();
        // $v->setView("","templateadmin-modal");
        // $v->assign("title", "Insrivez vous à la newsletter");
    }

    public function signUpAction(Request $request)
    {
        $post = $request->getPost();

        $form = User::getNewsletterSignUpForm();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = Validator::check($form["struct"], $post);
            if (!$errors) {
                if (!Validator::process($form["struct"], $post, 'signup-newsletter')) {
                    $errors=["email-newsletter"];
                } else {
                    Stat::add(1, "inscription newsletter", 5);
                    Route::redirect('SignUpNewsletterSuccess');
                }
            }
        }

        $v = new View();
        $v->setView("newsletter/signup", "templateadmin-modal");
        $v->massAssign([
            "title" => "Insrivez vous à la newsletter",
            "icon" => "icon-user-plus",
            "form" => $form,
            "errors" => $errors
        ]);
    }
}
