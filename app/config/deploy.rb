logger.level = Capistrano::Logger::INFO

set :application, "bec-russia"

set :repository, "git@github.com:rithis/#{application}.git"
set :scm, :git
set(:branch) { `git branch | grep '*' | cut -f 2 -d ' '`.strip! }

set :domain, "symfony.rithis.com"
server domain, :app, :db, :web, :primary => true
set :user, webserver_user
set(:deploy_to) { "/var/www/#{application}/#{branch}" }
set :use_sudo, false

set :use_composer, true
set :clear_controllers, false
set :dump_assetic_assets, true
set :symfony_env_prod, "dev"

set :shared_files, ["app/config/parameters.yml"]

set :database_propagation_type, :migrations
set :load_fixtures, true

before 'deploy' do
  puts "Deploing to #{user}@#{domain}:#{deploy_to}"
end

after 'deploy:create_symlink' do
  puts "Now you can open http://#{branch}.#{application}.#{domain}"
end

before 'symfony:composer:install', 'composer:copy_vendors'
before 'symfony:composer:update', 'composer:copy_vendors'
after 'deploy', 'deploy:cleanup'

namespace :composer do
  task :copy_vendors, :except => { :no_release => true } do
    capifony_pretty_print "--> Copy vendor file from previous release"

    run "vendorDir=#{current_path}/vendor; if [ -d $vendorDir ] || [ -h $vendorDir ]; then cp -a $vendorDir #{latest_release}/vendor; fi;"
    capifony_puts_ok
  end
end

namespace :symfony do
  namespace :foq do
    namespace :elastica do
      task :populate do
        run "#{try_sudo} sh -c 'cd #{latest_release} && #{php_bin} #{symfony_console} foq:elastica:populate --env=#{symfony_env_prod}'"
      end
    end
  end
end

namespace :rithis do
  task :init do
    require 'securerandom'

    database_name = "#{application}-#{branch}"

    parameters = File.open("app/config/parameters.dist.yml").read
    parameters = parameters.sub(%r{(.*secret: ).*}, '\1' + SecureRandom.hex(32))
    parameters = parameters.sub(%r{(.*database_host: ).*}, '\1127.0.0.1')
    parameters = parameters.sub(%r{(.*database_name: ).*}, '\1' + database_name)

    put(parameters, "#{shared_path}/app/config/parameters.yml")
    symfony.doctrine.database.create

    if database_propagation_type == :migrations
      symfony.doctrine.migrations.migrate
    elsif database_propagation_type == :schema_update
      symfony.doctrine.schema.update
    end

    if load_fixtures
      symfony.doctrine.fixtures.load
    end
  end
end
