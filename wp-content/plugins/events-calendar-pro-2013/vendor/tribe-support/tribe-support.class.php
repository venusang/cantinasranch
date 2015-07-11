<?php
/**
 * Class for managing technical support components
 *
 * @version 0.2
 */

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

if( !class_exists( 'TribeEventsProSupport' ) ) {
	class TribeEventsProSupport {

		/**
		 * Enforce Singleton Pattern
		 */
		private static $instance;
		public function getInstance() {
			if(null == self::$instance) {
				$className = __CLASS__;
				self::$instance = new $className;
			}
			return self::$instance;
		}

		private static $debug_log = array();
		public static $support;

		private function __construct( ) {
			//add_action( 'init', array( $this, 'addSupportLink'), 10 );
			add_action( 'wp_before_admin_bar_render', array( $this, 'addSupportForm') );
			add_action( 'tribe_debug', array( $this, 'logDebug' ), 8, 3 );
			add_action( 'tribe_help_tab_sections', array( $this, 'displayHelpTabInfo' ), 10, 0 );
		}

		public function addSupportLink() {
			if (class_exists('Debug_Bar')) {
				TribeEvents::debug(self::supportLink());
			}
		}

		public function addSupportForm() {
			if (class_exists('Debug_Bar')) {
				TribeEvents::debug(self::supportForm());
			}
		}

		public function displayHelpTabInfo() {

			$system_text[] = '<p>' . __("Sometimes it's hard to tell what's going wrong without knowing more about your system steup. For your convenience, we've put together a little report on what's cooking under the hood.", 'tribe-events-calendar-pro') . '</p>';
			$system_text[] = '<p>' . __("If you suspect that the problem you're having is related to another plugin, or we're just plain having trouble reproducing your bug report, please copy and send all of this to our support team.", 'tribe-events-calendar-pro') . '</p>';
			$system_text = implode($system_text);
			?>

			<h3><?php _e('System Information', 'tribe-events-calendar-pro'); ?></h3>
			<?php
			echo( apply_filters( 'tribe_help_tab_system', $system_text ) );
			echo self::formattedSupportStats();
			self::formattedSupportStatsStyle();
		}

		/**
		 * Generate a support link based on the user's options. This link is serialized and base64 encoded. On the other end we can decode it and then unserialize it to create a ticket.
		 *
		 * @return string
		 * @author Peter Chester
		 */
		public static function supportLink() {
			$text = __('Send a support request for this site.','tribe-events-calendar-pro');
			$link = TribeEvents::$tribeUrl.'support?supportinfo='.self::generateSupportHash();
			$html = '<div class="tribe-support-link"><a href="'.$link.'" target="_blank">'.$text.'</a></div>';
			return apply_filters('tribe-events-pro-support-link',$html,$link);
		}

		/**
		 * Generate a support form.
		 *
		 * @return string
		 * @author Peter Chester
		 */
		public static function supportForm() {
			ob_start();
			include( TribeEventsPro::instance()->pluginPath . 'admin-views/support-form.php' );
			$form = ob_get_contents();
			ob_get_clean();
			return $form;
		}

		/**
		 * Collect system information for support
		 *
		 * @return array of system data for support
		 * @author Peter Chester
		 */
		public static function getSupportStats() {
			$user = wp_get_current_user();

			$plugins = array();
			if ( function_exists( 'get_plugin_data' ) ) {
				$plugins_raw = wp_get_active_and_valid_plugins();
				foreach($plugins_raw as $k => $v) {
					$plugin_details = get_plugin_data($v);
					$plugin = $plugin_details['Name'];
					if ( !empty($plugin_details['Version']) ) $plugin .= sprintf(' version %s', $plugin_details['Version']);
					if ( !empty($plugin_details['Author']) ) $plugin .= sprintf(' by %s', $plugin_details['Author']);
					if ( !empty($plugin_details['AuthorURI']) ) $plugin .= sprintf('(%s)', $plugin_details['AuthorURI']);
					$plugins[] = $plugin;
				}
			}

			$network_plugins = array();
			if ( is_multisite() && function_exists( 'get_plugin_data' ) ) {
				$plugins_raw = wp_get_active_network_plugins();
				foreach($plugins_raw as $k => $v) {
					$plugin_details = get_plugin_data($v);
					$plugin = $plugin_details['Name'];
					if ( !empty($plugin_details['Version']) ) $plugin .= sprintf(' version %s', $plugin_details['Version']);
					if ( !empty($plugin_details['Author']) ) $plugin .= sprintf(' by %s', $plugin_details['Author']);
					if ( !empty($plugin_details['AuthorURI']) ) $plugin .= sprintf('(%s)', $plugin_details['AuthorURI']);
					$network_plugins[] = $plugin;
				}
			}

			$mu_plugins = array();
			if ( function_exists( 'get_mu_plugins' ) ) {
				$mu_plugins_raw = get_mu_plugins();
				foreach($mu_plugins_raw as $k => $v) {
					$plugin = $v['Name'];
					if ( !empty($v['Version']) ) $plugin .= sprintf(' version %s', $v['Version']);
					if ( !empty($v['Author']) ) $plugin .= sprintf(' by %s', $v['Author']);
					if ( !empty($v['AuthorURI']) ) $plugin .= sprintf('(%s)', $v['AuthorURI']);
					$mu_plugins[] = $plugin;
				}
			}

			$keys = apply_filters( 'tribe-pue-install-keys', array() );

			$systeminfo = array(
				'url' => 'http://'.$_SERVER["HTTP_HOST"],
				'name' => $user->display_name,
				'email' => $user->user_email,
				'install keys' => $keys,
				'WordPress version' => get_bloginfo('version'),
				'PHP version' => phpversion(),
				'plugins' => $plugins,
				'network plugins' => $network_plugins,
				'mu plugins' => $mu_plugins,
				'theme' => wp_get_theme()->get('Name'),
				'multisite' => is_multisite(),
				'settings' => TribeEvents::getOptions(),
				//'errors' => self::$debug_log
			);
			$systeminfo = apply_filters('tribe-events-pro-support',$systeminfo);
			return $systeminfo;
		}

		/**
		 * Generate a hash with all the system support information
		 *
		 * @return string of encoded support info
		 * @author Peter Chester
		 */
		public static function generateSupportHash() {
			$systeminfo = self::getSupportStats();
			$systeminfo = serialize($systeminfo);
			$systeminfo = base64_encode($systeminfo);
			return $systeminfo;
		}

		/**
		 * Render system information into a pretty output
		 *
		 * @return string pretty HTML
		 * @author Peter Chester
		 */
		public static function formattedSupportStats() {
			$systeminfo = self::getSupportStats();
			$output = '';
			$output .= '<dl class="support-stats">';
			foreach ( $systeminfo as $k => $v ) {

				switch ( $k ) {
					case 'name' :
					case 'email' :
						continue 2;
						break;
					case 'url' :
						$v = sprintf( '<a href="%s">%s</a>', $v, $v );
						break;
				}

				$output .= sprintf( '<dt>%s</dt>', $k );
				if ( empty( $v ) ) {
					$output .= '<dd class="support-stats-null">-</dd>';
				} elseif ( is_bool( $v ) ) {
					$output .= sprintf( '<dd class="support-stats-bool">%s</dd>', $v );
				} elseif ( is_string( $v ) ) {
					$output .= sprintf( '<dd class="support-stats-string">%s</dd>', $v );
				} elseif ( is_array( $v ) && is_numeric( array_shift( array_keys( $v ) ) ) ) {
					$output .= sprintf( '<dd class="support-stats-array"><ul><li>%s</li></ul></dd>', join('</li><li>', $v) );
				} else {
					$formatted_v = array();
					foreach ( $v as $obj_key => $obj_val ) {
						if ( is_array( $obj_val ) ) {
							$formatted_v[] = sprintf( '<li>%s = <pre>%s</pre></li>', $obj_key, print_r( $obj_val, TRUE ) );
						} else {
							$formatted_v[] = sprintf( '<li>%s = %s</li>', $obj_key, $obj_val );
						}
					}
					$v = join( "\n", $formatted_v );
					$output .= sprintf( '<dd class="support-stats-object"><ul>%s</ul></dd>', print_r( $v, TRUE ) );
				}
			}
			$output .= '</dl>';
			return $output;
		}

		public static function formattedSupportStatsStyle() {
			?>
			<style>
			dl.support-stats {
				background: #000;
				color: #888;
				padding: 10px;
				overflow: scroll;
				max-height: 400px;
				border-radius: 2px;
			}
			dl.support-stats dt {
				text-transform: uppercase;
				font-weight: bold;
				width: 25%;
				clear: both;
				float: left;
			}
			dl.support-stats dd {
				padding-left: 10px;
				margin-left: 25%;
			}
			</style>
			<?php
		}

		/**
		 * capture log messages for support requests.
		 *
		 * @param string $title - message to display in log
		 * @param string $data - optional data to display
		 * @param string $format - optional format (log|warning|error|notice)
		 * @return void
		 * @author Peter Chester
		 */
		public function logDebug($title,$data=false,$format='log') {
			self::$debug_log[] = array(
				'title' => $title,
				'data' => $data,
				'format' => $format,
			);
		}

	}

	TribeEventsProSupport::getInstance();
}
?>