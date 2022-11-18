# cURL

```python
 1.The Way to Download the Contents of a Remote Website to a Local File Using cURL in PHP<index.php>
```
In the first example, i am trying to view the home page of a Google website. The session was assigned with the curl_init(). This method will show the content of an assigned website into a particular curl_setopt() method. It will be saved as an html file for remote accessing.


```python
2.To Download a File from a Remote Site using cURL in PHP<file.php>
```
If the option CURLOPT_ FILE is activated, a remote file can be downloaded to our server. For example, the following code downloads "Microsoft new launch" from Microsoft company website and saves it to our server as the microsoft_new_launch.html:

The url_name is nothing but an original resource location of the website. The handle session will manage the session details of the current website location.

I use the curl_getinfo command to get more information about the request. This command allows us to get important technical information about the response, such as the status code (200 for success), and the size of the downloaded file.

Responce
`<?php

/*

 * vim: ts=4 sw=4 fdm=marker noet tw=78

 */

class curlDownloader

{

    private $remoteFileName = NULL;

    private $ch = NULL;

    private $headers = array();

    private $response = NULL;

    private $fp = NULL;

    private $debug = FALSE;

    private $fileSize = 0;

    const DEFAULT_FNAME = 'remote.out';

    public function __construct($url)

    {

        $this->init($url);

    }

    public function toggleDebug()

    {

        $this->debug = !$this->debug;

    }

    public function init($url)

    {

        if( !$url )

            throw new InvalidArgumentException("Need a URL");

        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, $url);

        curl_setopt($this->ch, CURLOPT_HEADERFUNCTION,

            array($this, 'headerCallback'));

        curl_setopt($this->ch, CURLOPT_WRITEFUNCTION,

            array($this, 'bodyCallback'));

    }

    public function headerCallback($ch, $string)

    {

        $len = strlen($string);

        if( !strstr($string, ':') )

        {

            $this->response = trim($string);

            return $len;

        }

        list($name, $value) = explode(':', $string, 2);

        if( strcasecmp($name, 'Content-Disposition') == 0 )

        {

            $parts = explode(';', $value);

            if( count($parts) > 1 )

            {

                foreach($parts AS $crumb)

                {

                    if( strstr($crumb, '=') )

                    {

                        list($pname, $pval) = explode('=', $crumb);

                        $pname = trim($pname);

                        if( strcasecmp($pname, 'filename') == 0 )

                        {

                            // Using basename to prevent path injection

                            // in malicious headers.

                            $this->remoteFileName = basename(

                                $this->unquote(trim($pval)));

                            $this->fp = fopen($this->remoteFileName, 'wb');

                        }

                    }

                }

            }

        }

        $this->headers[$name] = trim($value);

        return $len;

    }

    public function bodyCallback($ch, $string)

    {

        if( !$this->fp )

        {

            trigger_error("No remote filename received, trying default",

                E_USER_WARNING);

            $this->remoteFileName = self::DEFAULT_FNAME;

            $this->fp = fopen($this->remoteFileName, 'wb');

            if( !$this->fp )

                throw new RuntimeException("Can't open default filename");

        }

        $len = fwrite($this->fp, $string);

        $this->fileSize += $len;

        return $len;

    }

    public function download()

    {

        $retval = curl_exec($this->ch);

        if( $this->debug )

            var_dump($this->headers);

        fclose($this->fp);

        curl_close($this->ch);

        return $this->fileSize;

    }

    public function getFileName() { return $this->remoteFileName; }

    private function unquote($string)

    {

        return str_replace(array("'", '"'), '', $string);

    }

}

$dl = new curlDownloader(

    'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pexels.com%2Fsearch%2Ffree%2520download%2F&psig=AOvVaw3lIh07E0ZIZyNjqNl-JNSd&ust=1638024513705000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCKDNtfuitvQCFQAAAAAdAAAAABAD'

);

$size = $dl->download();

printf("Downloaded %u bytes to %s\n", $size, $dl->getFileName());

?>
`
