<?php

namespace App\Helpers;

class Template
{
    private $twig;

    public function __construct(string $path)
    {
        $loader = new \Twig\Loader\FilesystemLoader($path);
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../cache',
        ]);
    }

    public function render(string $view, array $data = [])
    {
        return $this->twig->render($view, $data);
    }

    public function addGlobal(string $name, $value)
    {
        $this->twig->addGlobal($name, $value);

        return $this;
    }

    public function addFunction(string $name, $function)
    {
        $this->twig->addFunction(new \Twig\TwigFunction($name, $function));

        return $this;
    }

    public function addFilter(string $name, $filter)
    {
        $this->twig->addFilter(new \Twig\TwigFilter($name, $filter));

        return $this;
    }

    public function addExtension(\Twig\Extension\ExtensionInterface $extension)
    {
        $this->twig->addExtension($extension);

        return $this;
    }

    public function addTokenParser(\Twig\TokenParser\TokenParserInterface $tokenParser)
    {
        $this->twig->addTokenParser($tokenParser);

        return $this;
    }

    public function addNodeVisitor(\Twig\NodeVisitor\NodeVisitorInterface $nodeVisitor)
    {
        $this->twig->addNodeVisitor($nodeVisitor);

        return $this;
    }

    public function addTest(\Twig\TwigTest $test)
    {
        $this->twig->addTest($test);

        return $this;
    }

    public function addRuntimeLoader(\Twig\RuntimeLoader\RuntimeLoaderInterface $runtimeLoader)
    {
        $this->twig->addRuntimeLoader($runtimeLoader);

        return $this;
    }

    public function addGlobalRuntimeLoader(\Twig\RuntimeLoader\RuntimeLoaderInterface $runtimeLoader)
    {
        $this->twig->addGlobalRuntimeLoader($runtimeLoader);

        return $this;
    }
}
