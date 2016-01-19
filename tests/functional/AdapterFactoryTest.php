<?php

use Ntb\Statistics\IndicatorFactory;

class FetchMemberTest extends SapphireTest {

    public function testGetMember() {
        $indicators = IndicatorFactory::get_all();
        foreach($indicators as $indicator) {
            if($indicator->name() === 'member.count') {
                $this->assertEquals(1, $indicator->fetch());
            }
        }
    }

    public function testAfterNewMembers() {
        $indicators = IndicatorFactory::get_all();
        foreach($indicators as $indicator) {
            if($indicator->name() === 'member.count') {
                $this->assertEquals(1, $indicator->fetch());
            }
        }
        // create 10 members
        for($i=0;$i < 10;$i++) {
            $u = new Member();
            $u->write();
        }
        $indicators = IndicatorFactory::get_all();
        foreach($indicators as $indicator) {
            if($indicator->name() === 'member.count') {
                $this->assertEquals(11, $indicator->fetch());
            }
        }
    }
}

class MemberCountIndicatorForTest implements \Ntb\Statistics\IIndicator, TestOnly {

    public function fetch() {
        return Member::get()->count();
    }

    public function name() {
        return 'member.count';
    }
}