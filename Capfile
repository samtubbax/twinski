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

begin
	# Deployment process
	namespace :deploy do
		desc 'Prepares the servers for deployment.'
		task :setup, :except => { :no_release => true } do
			# this method is overwritten because our application isn't a Rails-application

			# define folders to create
			dirs = [deploy_to, releases_path, shared_path]

			# add folder that aren't standard
			dirs += shared_children.map { |d| File.join(shared_path, d) }

			# create the dirs
			run %{
				#{try_sudo} mkdir -p #{dirs.join(' ')} &&
				#{try_sudo} chmod g+w #{dirs.join(' ')}
			}
		end

		task :finalize_update, :except => { :no_release => true } do
			# our application isn't a Rails-application so don't do Rails specific stuff
			run 'chmod -R g+w #{latest_release}' if fetch(:group_writable, true)
		end

		# overrule restart
		task :restart do; end
	end

	# define some extra folder to create
	set :shared_children, %w(app files)

	# custom events configuration
	after 'deploy:setup' do
		# create symlink for document_root if it doesn't exists
		documentRootExists = capture("if [ ! -e #{document_root} ]; then ln -sf #{current_path} #{document_root}; echo 'no'; fi").chomp

		unless documentRootExists == 'no'
			warn 'Warning: Document root (#{document_root}) already exists'
			warn 'to link it to the Fork deploy issue the following command:'
			warn '	ln -sf #{current_path} #{document_root}'
		end
	end

	after 'deploy:update_code' do
		# change the path to current_path
		run "if [ -f #{shared_path}/app/config.php ]; then sed -i 's/#{version_dir}\\/[0-9]*/#{current_dir}/' #{shared_path}/app/config.php; fi"

		# symlink the globals
		run %{
			ln -sf #{shared_path}/app/config.php #{release_path}/core/config.php
		}
	end

rescue LoadError
	$stderr.puts <<-INSTALL
You need the forkcms_deploy gem (which simplifies this Capfile) to deploy this application
Install the gem like this:
	gem install forkcms_deploy
				INSTALL
	exit 1
end