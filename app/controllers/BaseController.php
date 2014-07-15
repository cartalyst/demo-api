<?php

use Cartalyst\Api\Dispatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseController extends Controller {

	protected $api;

	public function __construct(Dispatcher $api)
	{
		$this->api = $api;
	}

	protected function api()
	{
		$args = func_get_args();

		$method = strtoupper(array_shift($args));

		$response = call_user_func_array(array($this->api, $method), $args);

		if ( ! $response->isSuccessful())
		{
			$uri = array_shift($args);
			$statusCode = $response->getStatusCode();

			$message = sprintf(
				'API: "%s /%s" returned a %d status.',
				$method,
				$uri,
				$statusCode
			);

			$data = $response->getData();

			if (is_array($data) and isset($data['errors']))
			{
				foreach ($data['errors'] as $error)
				{
					$message .= "\n$error";
				}
			}

			throw new HttpException($statusCode, $message);
		}

		return $response->getData()['data'];
	}

	protected function checkAccess($permission)
	{
		return (Sentinel::check() && Sentinel::hasAccess($permission));
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
