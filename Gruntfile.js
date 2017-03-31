// /**
//  * @module     GruntFile
//  * @desc       Grunt configuration
//  * @author     Jose Segura Nietzen
//  */
var route = 'js/';
var php   = 'php -d memory-limit=-1 app/console';
'use strict'; 

module.exports = function(grunt) {
	grunt.log.writeln('-------------------------------------------------------------');
	grunt.log.writeln('|                                                           |');
	grunt.log.writeln('|                                                           |');
	grunt.log.writeln('| Bienvenido a la configuracion de grunt  @Author   Nietzen |');
	grunt.log.writeln('|                                                           |');
	grunt.log.writeln('|                                                           |');
	grunt.log.writeln('-------------------------------------------------------------');

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// javascript concatena archivos a uno
		concat: {
		    options: {
		      separator: ';',
		    },
		    dist: {
		      src: [
		      		
					route + 'js/'	     + 'main.js',
					route + 'js/'	     + 'plugins.js'
		      	] ,
		      dest: 'js/all.js',
		    },
		  },

		// javascript agarra el archivo concatenado y lo minifica
		uglify: {
		    my_target: {
		      files: {
		        'web/js/main.min.js'   : ['js/all.js']
		      }
		    }
		  },

		// javascript end


		//  sass
		compass: {      
		    dist: {     
		      options: { 
		      	
		      	config :     'config.rb',
		      	environment: 'production',
		      	debugInfo:    false,
		      	outputStyle: 'compressed'		        

		      }
		    }
	    },

		exec: {
		  limpia:      'clear',
		  clearCacheFast:  'sudo rm -rf app/cache/* && chmod -R 765 app/cache/ && echo "Proceso terminado"',
		  clearCache: 'rm -rf app/cache/* && chmod -R 766 app/cache/ && '+ php +' cache:warmup --env=prod && ' + php + 'cache:warmup --env=dev && echo "Proceso terminado"'
		},

		watch: {			
		  scripts: {
		    files: '**/*.js',
		    tasks: ['exec:limpia', 'concat', 'uglify']		    
		  },
		  sass: {
		  	files : '**/*.scss',
		  	tasks: ['exec:limpia', 'compass']
		  }
		}


	});
	
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-exec');


	grunt.registerTask('run',['concat', 'uglify']);
	grunt.registerTask('javascritp',['watch:scripts']);
	grunt.registerTask('sass',[ 'watch:sass']);
	grunt.registerTask('all',[ 'watch']);

	grunt.registerTask('clear',[ 'exec:limpia']);
	grunt.registerTask('cacheFast',[ 'exec:clearCacheFast']);
	grunt.registerTask('cache',[ 'exec:clearCache']);
	
}


