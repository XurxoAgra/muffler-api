<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->exclude(['var', 'vendor', 'node_modules']);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,

        // Estilo y limpieza
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'no_superfluous_phpdoc_tags' => true,
        'phpdoc_trim' => true,
        'phpdoc_order' => true,
        'phpdoc_separation' => true,

        // Código seguro y explícito
        'strict_param' => true,
        'declare_strict_types' => true,

        // Buenas prácticas
        'class_attributes_separation' => ['elements' => ['method' => 'one']],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'single_trait_insert_per_statement' => true,

        // DDD: limpieza de clases sin comentarios innecesarios
        'no_blank_lines_after_class_opening' => true,
        'blank_line_after_namespace' => true,
        'blank_line_before_statement' => ['statements' => ['return']],
    ])
    ->setFinder($finder);
