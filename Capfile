load 'deploy' if respond_to?(:namespace) # cap2 differentiator

# set your application name here
set :application, "twisnkitest"

# set user to use on server
# eg.: sumocoders
set :user, "root"

# deploy to path (on server)
# eg.: /home/#{user}/apps/#{application}
set :deploy_to, "/home/gittest/apps/gittest"

# set document_root
# eg.: /home/#{user}/public_html
set :document_root, "/home/gittest/public_html"

# define roles
# eg.: crsolutions.be
server "37.34.49.223", :app, :web, :db, :primary => true

# git repo & branch
# eg.: git@crsolutions.be:sumocoders.be.git
set :repository, "git@github.com:samtubbax/twinski.git"
set :branch, "master"

# set version control type and copy strategy
set :scm, :git
set :copy_strategy, :checkout

# don't use sudo, on most shared setups we won't have sudo-access
set :use_sudo, false

# we're on a share setup so group_writable isn't allowed
set :group_writable, false

# 3 releases should be enough.
set :keep_releases, 2

# remote caching will keep a local git repo on the server you're deploying to and simply run a fetch from that
# rather than an entire clone. This is probably the best option and will only fetch the differences each deploy
set :deploy_via, :remote_cache

# set the value for pseudo terminals in Capistrano
default_run_options[:pty] = true

# your computer must be running ssh-agent for the git checkout to work from the server to the git server
set :ssh_options, { :forward_agent => true }
