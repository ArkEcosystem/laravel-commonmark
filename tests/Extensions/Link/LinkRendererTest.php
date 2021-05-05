<?php

use ARKEcosystem\CommonMark\Extensions\Link\LinkRenderer;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Element\Text;

use League\CommonMark\Inline\Renderer\TextRenderer;
use League\CommonMark\Util\Configuration;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('should render internal/external links', function (string $url) {
    $subject = new LinkRenderer();
    $subject->setConfiguration(new Configuration());

    $environment = new Environment();
    $environment->addInlineRenderer(Text::class, new TextRenderer());

    assertMatchesSnapshot((string) $subject->render(new Link($url, 'Label', 'Title'), new HtmlRenderer($environment)));
})->with([
    'https://google.com',
    'https://ourapp.com',
    '#heading',
    '/path/segment',
]);
