Db Migration Assitant (in Php)
------------------------------

Why
===

An fun little experiment to get a dsl as close to ActiveRecord style migrations as possible in Php. After hacking on this these last few days, I've acquired a huge amount of respect for the guys who've actually done it - and continue to I guess :) - inside ActiveRecord itself.

I don't have much yet by any means, but what little I do have is already much better than the plain sql migration scripts I've worked with in the past IMO.

What
====

This:

	create table A (
		`id` int(11) primary key,
		`title` varchar (255) not null,
		`body` text
	) engine=innodb;

Becomes:

	function up() {
		$t = create_table('A');
		$t->text('title', array('limit' => 255, 'null' => false));
		$t->text('body');
	}

Like Rails, id columns are created automatically for every table unless explicitly told otherwise. Data types are abstracted away from table definitions. For example, everything character related is defined in Php as text. When the migration is run the most appropriate type is chosen. 

Examples:

-	$t->text('body') would emit `body` text
-	$t->text('title', array('limit' => 255) would emit `title` varchar(255)

A database is defined by a series of small, incremental changes that when applied in the right order, eventually converge on something that exactly matches your production database. Which was certainly possible before ActiveRecord I guess, but what _is_ new is all this other fun stuff: 

-	You can run your migrations on Oracle, DB2, mysql, etc. (datatypes take care of themselves)
-	You get a runner that handles roll forward and back
-	As with everything else in Rails, you get a template generator

Todo
====

-	Quite a bit

Contributors
============

-	That would be me (Christian Leskowsky)

