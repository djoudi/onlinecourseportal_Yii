<<<<<<< HEAD
<?php

interface SampleInterfaceWithHintInSignature {
    function method(array $hinted);
}

class TestOfInterfaceMocksWithHintInSignature extends UnitTestCase {
    function testBasicConstructOfAnInterfaceWithHintInSignature() {
        Mock::generate('SampleInterfaceWithHintInSignature');
        $mock = new MockSampleInterfaceWithHintInSignature();
        $this->assertIsA($mock, 'SampleInterfaceWithHintInSignature');
    }
}

=======
<?php

interface SampleInterfaceWithHintInSignature {
    function method(array $hinted);
}

class TestOfInterfaceMocksWithHintInSignature extends UnitTestCase {
    function testBasicConstructOfAnInterfaceWithHintInSignature() {
        Mock::generate('SampleInterfaceWithHintInSignature');
        $mock = new MockSampleInterfaceWithHintInSignature();
        $this->assertIsA($mock, 'SampleInterfaceWithHintInSignature');
    }
}

>>>>>>> refs/remotes/origin/master
