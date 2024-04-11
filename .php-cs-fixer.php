<?php
$config = new PhpCsFixer\Config();
return $config
  ->setIndent('  ')
  ->setRules([
    'single_quote' => true,
    'indentation_type' => true,
    'array_indentation' => true,
    'array_syntax' => true,
    'braces' => true,
    'doctrine_annotation_indentation' => true,
    'heredoc_indentation' => true,
    'indentation_type' => true,
    'method_argument_space' => true,
    'method_chaining_indentation' => true,
    'phpdoc_indent' => true,
    'single_quote' => true,
    'statement_indentation' => true,
    'no_spaces_after_function_name' => true,
    'no_spaces_around_offset' => true,
    'cast_spaces' => true,
    'spaces_inside_parentheses' => true,
    'trim_array_spaces' => true,
    'single_line_empty_body' => true,
    'function_declaration' => false,
    'braces_position'	=> [
      'classes_opening_brace'	=> 'same_line',
      'functions_opening_brace'	=> 'same_line',
    ],
  ])
  ->setFinder(
    PhpCsFixer\Finder::create()
      ->in(__DIR__)
  );
