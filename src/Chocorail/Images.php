<?php
namespace Chocorail;

class Images
{
    protected $chocorail;
    protected $options;

    public function __construct(Chocorail $chocorail, array $options)
    {
        $this->chocorail = $chocorail;
        $this->options = $options;
    }

    // makeUploadsURL("testdata/large.jpg", "/c!/w=300/")
    public function makeUploadsURL($objectName, $convertString)
    {
        if (strpos($objectName, '/') == 0) {
            throw new Exception('objectName must not be starts with /');
        }
        if (strpos($convertString, '/c!/') !== 0) {
            throw new Exception('convertString must be starts with /c!/');
        }

        $path = $convertString.$objectName;
        $sigval = $this->createURLSignatureString(
            $path,
            $this->options['urlSignatureKeyVersion'], 
            $this->options['urlSignatureKey'],
            $this->options['originSlug']);
        return '/uploads'.$path.'?sig='.$sigval;
    }

    // createURLSignatureString("/c!/w=300/testdata/large.jpg", 1, "secrettext", "abcd")
    private function createURLSignatureString($path, $version, $key, $originSlug)
    {
        $b = '';

        if ($originSlug != "") {
            $b .= $originSlug.'-';
        }

        $b .= $version.'.';
        $b .= $this->calcURLSignatureValue($path, $key);

        return $b;
    }

    private function calcURLSignatureValue($path, $key)
    {
        $hashval = hash_hmac('sha256', $path, $key, true);
        return rtrim(strtr(base64_encode($hashval), '+/', '-_'), '=');
    }
}
