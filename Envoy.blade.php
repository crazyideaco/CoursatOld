@servers(['web' =>'azcour@azcourses.net'])


@setup
    $repository = 'git@github.com:AhmedNader65/Coursat.git';
    $app_dir = '/home/azcour/public_html/';
@endsetup

@story('deploy')
    pull_repository
@endstory


@task('pull_repository')
    echo 'Pulling repository'
    cd {{ $app_dir }}
    git stash
    git pull origin master



@endtask

...
