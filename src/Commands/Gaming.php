<?php

namespace Jiko\Gaming\Commands;

use Illuminate\Console\Command;

class Gaming extends Command
{
  protected $signature = 'gaming {--check-live} {--all}';

  protected $description = 'run batch of gaming commands';

  public function handle()
  {
    $this->call("stream:check-live");
  }
}