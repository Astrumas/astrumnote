# --------------------------------------------------
# Convenience Methods
# --------------------------------------------------

def run(cmd)
    puts(cmd)
    system(cmd)
end

def run_unit_tests()
    run( "phpunit --colors test" )
end

# --------------------------------------------------
# Watchr Rules
# --------------------------------------------------
watch( '^test/.*/.*\.php'   )   { |m| run_unit_tests() }
watch( '^lib/.*\.php'   )   { |m| run_unit_tests() }
run_unit_tests()

