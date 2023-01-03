<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\LoadViews;

use App\Models\QuestionModel;
use App\Models\ChoiceModel;
use App\Models\UserModel;
use App\Models\ExamModel;
use App\Models\StudentExamModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */

    protected $loadviews;
    protected $request;
    protected $session;
    protected $validation;
    protected $userModel;
    protected $choiceModel;
    protected $studentexamModel;
    protected $examModel;
    protected $questionModel;
    
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'form'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->validation        = \Config\Services::validation();
        $this->session           = \Config\Services::session();

        $this->loadviews         = new LoadViews();
        $this->userModel         = new UserModel();
        $this->choiceModel       = new ChoiceModel();
        $this->studentexamModel  = new StudentExamModel();
        $this->examModel         = new ExamModel();
        $this->questionModel     = new QuestionModel();

        date_default_timezone_set('America/Argentina/Salta');
    }
}
