<?php

use Cartalyst\Api\Response;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ApiController extends Controller {

	protected $statusCode = 200;

	public function __construct(Manager $fractal)
	{
		$this->fractal = $fractal;

		// Are we going to try and include embedded data?
		$this->fractal->parseIncludes(Input::get('include', []));
	}

	/**
	 * Getter for statusCode
	 *
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Setter for statusCode
	 *
	 * @param int $statusCode Value to set
	 *
	 * @return self
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * Returns the given item.
	 *
	 * @param  mixed  $item
	 * @param  mixed  $callback
	 * @return \Cartalyst\Api\Response
	 */
	protected function respondWithItem($item, $callback)
	{
		$resource = new Item($item, $callback);

		$rootScope = $this->fractal->createData($resource);

		return $this->respondWithArray($rootScope->toArray());
	}

	/**
	 * Returns the given collection.
	 *
	 * @param  mixed  $collection
	 * @param  mixed  $callback
	 * @return \Cartalyst\Api\Response
	 */
	protected function respondWithCollection($collection, $callback)
	{
		$resource = new Collection($collection, $callback);

		$rootScope = $this->fractal->createData($resource);

		return $this->respondWithArray($rootScope->toArray());
	}

	/**
	 * Returns the given data.
	 *
	 * @param  array  $data
	 * @param  array  $headers
	 * @return \Cartalyst\Api\Response
	 */
	protected function respondWithArray(array $array, array $headers = [])
	{
		return new Response($array, $this->statusCode, $headers);

	}

	/**
	 * Returns a response with an error response code.
	 *
	 * @param  array  $item
	 * @param  int  $code
	 * @return \Cartalyst\Api\Response
	 */
	protected function responseWithErrors($errors, $code)
	{
		$errors = (array) $errors;

		return new Response(compact('errors'), $code);
	}

	/**
	 * Returns a response with the no content response code.
	 *
	 * @return \Cartalyst\Api\Response
	 */
	protected function responseWithNoContent()
	{
		return new Response('', 204);
	}

	protected function checkAccess($permission)
	{
		// On sub-requests (internal requests), we don't want to enforce access to
		// edit resources at runtime when accessing an API resource. This should be
		// done on the UI side. It doesn't matter where you call API methods from,
		// be it a controller or a CLI command, we only care about checking access
		// when we're being hit directly from a HTTP request.
		if (API::isSubRequest())
		{
			return true;
		}

		return (Sentinel::check() && Sentinel::hasAccess($permission));
	}

}
