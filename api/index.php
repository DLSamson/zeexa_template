<?php

if (!empty($_SERVER['With']) && strtolower($_SERVER['X-Requested-With']) == 'xmlhttprequest') {
    sendResponse('Forbidden', 403, 'Forbidden');
}

define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once dirname(__FILE__, 2) . '/vendor/autoload.php';

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use URLify;

$routes = [
    'ping' => function (array $request, array $response = []) {
        sendResponse([
            'text' => 'pong'
        ]);
    },
    'echo' => function (array $request, array $response = []) {
        sendResponse([
            'text' => $request['text']
        ]);
    },
    'form.review' => function (array $request, array $response = []) {
        $iblock = [
            'IBLOCK_ID' => 212,
            'IBLOCK_SECTION' => false,
            'type' => 'aspro_allcorp3_content'
        ];
        $getFields = function ($data) {
            /** @var array $fields */
            $fields = $data['data'];
            /** @var UploadedFile[] $files */
            $files = collect($data['files'])
                ->map(function(UploadedFile $file, $name) {
                    return uploadFile($_SERVER['DOCUMENT_ROOT']."/upload/reviews/$name", $file);
                });

            $fields = [
                'NAME' => $fields['name'],
                'PREVIEW_TEXT' => $fields['message'],
                'PREVIEW_PICTURE' => CFILE::MakeFileArray($files['photo']),
                'CODE' => URLify::slug($fields['name'].'-'.uniqid()),
                'ACTIVE' => 'N',
                'PROPERTY_VALUES' => [
                    'EMAIL' => $fields['email'],
                    'PHONE' => $fields['phone'],
                    'POST' => $fields['post'],
                    'RATING' => ((int) $fields['rating']) + 855,
                    'DOCUMENTS' => [CFILE::MakeFileArray($files['file'])],
                ],
            ];
            // dd($fields);
            return $fields;
        };
        $validationRules = new Assert\Collection([
            'agreement' => [new Assert\NotNull(), new Assert\EqualTo('on')],
            'email' => [new Assert\NotBlank(), new Assert\NotNull(), new Assert\Email()],
            'name' => [new Assert\NotBlank(), new Assert\NotNull()],
            'message' => [new Assert\NotBlank(), new Assert\NotNull()],

            'rating' => new Assert\Optional([new Assert\Range(['min' => 1, 'max' => 5])]),
            'photo' => new Assert\Optional([new Assert\Image()]),
            'file' => new Assert\Optional([new Assert\File()]),
            'post' => new Assert\Optional([new Assert\NotBlank(), new Assert\NotNull()]),
            'phone' => new Assert\Optional([new Assert\NotBlank(), new Assert\NotNull()]),
        ]);

        handleForm($iblock, $getFields, $validationRules, $request);
    },
    'form.vacancy' => function (array $request, array $response = []) {
         $iblock = [
            'IBLOCK_ID' => 187,
            'IBLOCK_SECTION' => false,
            'type' => 'aspro_allcorp3_form'
        ];
        $getFields = function ($data) {
            /** @var array $fields */
            $fields = $data['data'];
            /** @var UploadedFile[] $files */
            $files = collect($data['files'])
                ->map(function(UploadedFile $file, $name) {
                    return uploadFile($_SERVER['DOCUMENT_ROOT']."/upload/vacancy/$name", $file);
                });

            $fields = [
                'NAME' => 'Заявка от '.date('d.m.Y'),
                'ACTIVE' => 'N',
                'PROPERTY_VALUES' => [
                    'FIO' => $fields['name'],
                    'PHONE' => $fields['phone'],
                    'EMAIL' => $fields['email'],
                    'POST' => $fields['post'],
                    'MESSAGE' => $fields['message'],
                    'FILE' => CFILE::MakeFileArray($files['file']),
                ],
            ];
            // dd($fields);
            return $fields;
        };
        $validationRules = new Assert\Collection([
            'agreement' => [new Assert\NotNull(), new Assert\EqualTo('on')],
            'name' => [new Assert\NotBlank(), new Assert\NotNull()],
            'phone' => [new Assert\NotBlank(), new Assert\NotNull()],
            'email' => new Assert\Optional([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Email()]),
            'post' => [new Assert\NotBlank(), new Assert\NotNull()],
            'message' => new Assert\Optional([new Assert\NotBlank(), new Assert\NotNull()]),
            'file' => new Assert\Optional([new Assert\File()]),
        ]);

        handleForm($iblock, $getFields, $validationRules, $request);
    },
    'form.question' => function (array $request, array $response = []) {
         $iblock = [
            'IBLOCK_ID' => 188,
            'IBLOCK_SECTION' => false,
            'type' => 'aspro_allcorp3_form'
        ];
        $getFields = function ($data) {
            /** @var array $fields */
            $fields = $data['data'];
            /** @var UploadedFile[] $files */
            $files = collect($data['files'])
                ->map(function(UploadedFile $file, $name) {
                    return uploadFile($_SERVER['DOCUMENT_ROOT']."/upload/vacancy/$name", $file);
                });

            $fields = [
                'NAME' => 'Вопрос от '.date('d.m.Y'),
                'ACTIVE' => 'N',
                'PROPERTY_VALUES' => [
                    'NAME' => $fields['name'],
                    'PHONE' => $fields['phone'],
                    'NEED_PRODUCT' => $fields['product'],
                    'MESSAGE' => $fields['product'],
                    'EMAIL' => $fields['email'] ?? '',
                ],
            ];
            // dd($fields);
            return $fields;
        };
        $validationRules = new Assert\Collection([
            'agreement' => [new Assert\NotNull(), new Assert\EqualTo('on')],
            'name' => [new Assert\NotBlank(), new Assert\NotNull()],
            'phone' => [new Assert\NotBlank(), new Assert\NotNull()],
            'product' =>new Assert\Optional( [new Assert\NotBlank(), new Assert\NotNull()]),
            'message' => new Assert\Optional([new Assert\NotBlank(), new Assert\NotNull()]),
            'email' => new Assert\Optional([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Email()]),
        ]);

        handleForm($iblock, $getFields, $validationRules, $request);
    },
    'form.call' => function (array $request, array $response = []) {
         $iblock = [
            'IBLOCK_ID' => 189,
            'IBLOCK_SECTION' => false,
            'type' => 'aspro_allcorp3_form'
        ];
        $getFields = function ($data) {
            /** @var array $fields */
            $fields = $data['data'];
            /** @var UploadedFile[] $files */
            $files = collect($data['files'])
                ->map(function(UploadedFile $file, $name) {
                    return uploadFile($_SERVER['DOCUMENT_ROOT']."/upload/vacancy/$name", $file);
                });

            $fields = [
                'NAME' => 'Заявка от '.date('d.m.Y'),
                'ACTIVE' => 'N',
                'PROPERTY_VALUES' => [
                    'FIO' => $fields['name'],
                    'PHONE' => $fields['phone'],
                ],
            ];
            // dd($fields);
            return $fields;
        };
        $validationRules = new Assert\Collection([
            'agreement' => [new Assert\NotNull(), new Assert\EqualTo('on')],
            'name' => [new Assert\NotBlank(), new Assert\NotNull()],
            'phone' => [new Assert\NotBlank(), new Assert\NotNull()],
        ]);

        handleForm($iblock, $getFields, $validationRules, $request);
    },
    'form.lead' => function (array $request, array $response = []) {
        $iblock = [
           'IBLOCK_ID' => 168,
           'IBLOCK_SECTION' => false,
           'type' => 'aspro_scorp_form'
       ];
       $getFields = function ($data) {
           /** @var array $fields */
           $fields = $data['data'];

           $fields = [
               'NAME' => 'Сообщение формы от '.date('d.m.Y'),
               'ACTIVE' => 'Y',
               'PROPERTY_VALUES' => [
                   'NAME' => $fields['name'],
                   'AVTO' => $fields['car-model'],
                   'DATE' => $fields['date'],
                   'PHONE' => $fields['phone'],
               ],
           ];
           // dd($fields);
           return $fields;
       };
       $validationRules = new Assert\Collection([
        //    'agreement' => [new Assert\NotNull(), new Assert\EqualTo('on')],
           'name' => [new Assert\NotBlank(), new Assert\NotNull()],
           'car-model' => [new Assert\NotBlank(), new Assert\NotNull()],
           'date' => [new Assert\NotBlank(), new Assert\NotNull()],
           'phone' => [new Assert\NotBlank(), new Assert\NotNull()],
       ]);

       handleForm($iblock, $getFields, $validationRules, $request);
   },
];

try {
    handleRequest($routes);
} catch (Throwable $e) {
    sendResponse(null, 500, $e->getMessage());
}

/**
 * Handle the request.
 *
 * @param array<string, callable> $routes The routes mapping.
 * @return void
 */
function handleRequest(array $routes = []): void
{
    $command = $_GET['command'] ?? '';
    $handler = $routes[$command] ?? null;
    $requestData = collect($_POST)
        ->map(function ($value) {
            return $value === ''
                ? null : $value;
        })
        ->filter(fn ($val) => !is_null($val));

    $files = collect($_FILES)
        ->filter(fn ($value) => $value['error'] == 0)
        ->map(function ($value) {
            //string $path, string $originalName, string $mimeType = null
            // sendResponse($value);
            return new UploadedFile($value['tmp_name'], $value['name'], $value['type'], $value['error']);
        });
    $requestData = [
        'files' => $files->toArray(),
        'data' => $requestData->toArray(),
    ];

    if (!$handler) {
        sendResponse(null, 404, 'Method not Implemented');
    }

    $handler($requestData);
}

/**
 * Sends a JSON response.
 *
 * @param mixed $data The data to be sent in the response.
 * @param int $code The HTTP status code of the response. Default is 200.
 * @param string $message The message of the response. Default is 'OK'.
 * @return void
 */
function sendResponse($data, int $code = 200, string $message = 'OK'): void
{
    header("HTTP/1.1 {$code} {$message}");
    header('Content-Type: application/json');

    exit(json_encode([
        'data' => $data,
        'code' => $code,
        'message' => $message
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

function handleForm(array $iblock, $getFields, $validationRules, array $data)
{
    $validator = Validation::createValidator();
    $errors = collect($validator->validate(array_merge($data['data'], $data['files']), $validationRules))
        ->map(function (ConstraintViolation $error) {
            return [
                'field' => substr($error->getPropertyPath(), 1, -1),
                'message' => $error->getMessage(),
            ];
        });

    if (count($errors) > 0) {
        sendResponse(['errors' => $errors], 400, 'Validation failed');
    }

    $params = collect($getFields($data))
        ->merge($iblock)
        ->toArray();

    $iblock =  new \CIBlockElement();
    $iblock_id = $iblock->Add($params);


    if ($iblock_id) {
        sendResponse([
            'id' => $iblock_id,
            'message' => 'Форма успешно отправлена',
        ], 200, 'OK');
    } else {
        throw new Error("Could not save iblock element: {$iblock->LAST_ERROR}, params: " . json_encode($params, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}


function uploadFile(string $directory, UploadedFile $file): string 
{
    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $safeFilename = URLify::slug($originalFilename);
    $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
    $file->move($directory, $fileName);

    return $directory.'/'.$fileName;
}