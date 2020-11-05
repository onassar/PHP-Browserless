<?php

    // Namespace overhead
    namespace onassar\Browserless;
    use onassar\RemoteRequests;

    /**
     * Base
     * 
     * PHP wrapper for Browserless.
     * 
     * @link    https://github.com/onassar/PHP-Browserless
     * @author  Oliver Nassar <onassar@gmail.com>
     * @extends RemoteRequests\Base
     */
    class Base extends RemoteRequests\Base
    {
        /**
         * _host
         * 
         * @access  protected
         * @var     string (default: 'chrome.browserless.io')
         */
        protected $_host = 'chrome.browserless.io';

        /**
         * _paths
         * 
         * @access  protected
         * @var     array
         */
        protected $_paths = array(
            'function' => '/function'
        );

        /**
         * _requestBody
         * 
         * @access  protected
         * @var     null|string (default: null)
         */
        protected $_requestBody = null;

        /**
         * _requestTimeout
         * 
         * @access  protected
         * @var     int (default: 300)
         */
        protected $_requestTimeout = 300;

        /**
         * _token
         * 
         * @access  protected
         * @var     null|string (default: null)
         */
        protected $_token = null;

        /**
         * _getFunctionURL
         * 
         * @access  protected
         * @return  string
         */
        protected function _getFunctionURL(): string
        {
            $host = $this->_host;
            $path = $this->_paths['function'];
            $token = $this->_token;
            $url = 'https://' . ($host) . ($path) . '?token=' . ($token);
            return $url;
        }

        /**
         * _getRequestStreamContextOptions
         * 
         * @access  protected
         * @return  array
         */
        protected function _getRequestStreamContextOptions(): array
        {
            $options = parent::_getRequestStreamContextOptions();
            $options['http']['header'] = 'Content-type: application/json';
            $requestBody = $this->_requestBody;
            if ($requestBody === null) {
                return $options;
            }
            $options['http']['content'] = $this->_requestBody;
            return $options;
        }

        /**
         * runFunction
         * 
         * @access  public
         * @param   array $package
         * @return  null|string
         */
        public function runFunction(array $package): ?string
        {
            $url = $this->_getFunctionURL();
            $this->_requestBody = json_encode($package);
            $this->setRequestMethod('post');
            $this->setURL($url);
            $response = $this->_getURLResponse();
            return $response;
        }

        /**
         * setToken
         * 
         * @access  public
         * @param   string $token
         * @return  void
         */
        public function setToken(string $token): void
        {
            $this->_token = $token;
        }
    }
