<?php

use OpenAI\Responses\Chat\CreateStreamedResponseDelta;

test('from first chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamFirstChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBe('assistant')
        ->content->toBeNull();
});

test('from content chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamContentChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBeNull()
        ->content->toBe('Hello');
});

test('from content chunk with only zero', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamContentZeroChunk()['choices'][0]['delta']);

    expect($result)
        ->role->toBeNull()
        ->content->toBe('0');
});

test('to array from first chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamFirstChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamFirstChunk()['choices'][0]['delta']);
});

test('to array for a content chunk', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamContentChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamContentChunk()['choices'][0]['delta']);
});

test('to array for a content chunk with only zero', function () {
    $result = CreateStreamedResponseDelta::from(chatCompletionStreamContentZeroChunk()['choices'][0]['delta']);

    expect($result->toArray())
        ->toBe(chatCompletionStreamContentZeroChunk()['choices'][0]['delta']);
});
