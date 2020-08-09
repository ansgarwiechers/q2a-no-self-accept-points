The points system in [Question2Answer][1] allows for awarding points for
accepting an answer to the user accepting the answer, which serves as an
incentive to actually mark an answer as "best answer." However, the software
awards the points regardless of whether the answer is from the person asking the
question or someone else, and doesn't provide an option to change that behavior.
This might tempt some people to increase their points by posting a lot of
(trivial) questions and accepting their own (trivial) answer.

This plugin changes the default behavior so that points are only awarded to the
user accepting an answer if that answer wasn't posted by themselves.

To activate it, copy the plugin directory to the plugins directory of your
Question2Answer site (or clone this repository there), then log in as the site
admin and enable the plugin under *Admin&nbsp;&rarr; Plugins*.

[1]: https://question2answer.org/
