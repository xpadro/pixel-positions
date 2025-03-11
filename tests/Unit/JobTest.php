<?php

use App\Models\Employer;
use App\Models\Job;

it('belongs to an employer', function () {
    expect(true)->toBeTrue();
    //Arrange
    $employer = Employer::factory()->create();

    //Override employer_id property by setting the id as the one from $employer
    $job = Job::factory()->create(['employer_id' => $employer->id]);

    //Act & Assert
    expect($job->employer()->is($employer))->toBeTrue();
});

it('can have tags', function () {
    //Arrange
    $job = Job::factory()->create();

    //Act
    $job->tag('Frontend');

    //Assert
    expect($job->tags)->toHaveCount(1);
});
