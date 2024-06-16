import { coerceToTwelveHours, rangeLimit, toTwelveHours, toTwentyFourHours } from '@/utils/time';
import { afterAll, beforeAll, describe, expect, it } from 'vitest';

describe('toTwentyFourHours', () => {
  const AM = true;
  const PM = false;

  it('should convert times correctly', () => {
    expect(toTwentyFourHours(12, AM)).to.eql(0);
    expect(toTwentyFourHours(1, AM)).to.eql(1);
    expect(toTwentyFourHours(2, AM)).to.eql(2);
    expect(toTwentyFourHours(3, AM)).to.eql(3);
    expect(toTwentyFourHours(4, AM)).to.eql(4);
    expect(toTwentyFourHours(5, AM)).to.eql(5);
    expect(toTwentyFourHours(6, AM)).to.eql(6);
    expect(toTwentyFourHours(7, AM)).to.eql(7);
    expect(toTwentyFourHours(8, AM)).to.eql(8);
    expect(toTwentyFourHours(9, AM)).to.eql(9);
    expect(toTwentyFourHours(10, AM)).to.eql(10);
    expect(toTwentyFourHours(11, AM)).to.eql(11);
    expect(toTwentyFourHours(12, PM)).to.eql(12);
    expect(toTwentyFourHours(1, PM)).to.eql(13);
    expect(toTwentyFourHours(2, PM)).to.eql(14);
    expect(toTwentyFourHours(3, PM)).to.eql(15);
    expect(toTwentyFourHours(4, PM)).to.eql(16);
    expect(toTwentyFourHours(5, PM)).to.eql(17);
    expect(toTwentyFourHours(6, PM)).to.eql(18);
    expect(toTwentyFourHours(7, PM)).to.eql(19);
    expect(toTwentyFourHours(8, PM)).to.eql(20);
    expect(toTwentyFourHours(9, PM)).to.eql(21);
    expect(toTwentyFourHours(10, PM)).to.eql(22);
    expect(toTwentyFourHours(11, PM)).to.eql(23);
  });
});

describe('toTwelveHours', () => {
  it('should convert times correctly', () => {
    expect(toTwelveHours(0)).to.eql(12);
    expect(toTwelveHours(1)).to.eql(1);
    expect(toTwelveHours(2)).to.eql(2);
    expect(toTwelveHours(3)).to.eql(3);
    expect(toTwelveHours(4)).to.eql(4);
    expect(toTwelveHours(5)).to.eql(5);
    expect(toTwelveHours(6)).to.eql(6);
    expect(toTwelveHours(7)).to.eql(7);
    expect(toTwelveHours(8)).to.eql(8);
    expect(toTwelveHours(9)).to.eql(9);
    expect(toTwelveHours(10)).to.eql(10);
    expect(toTwelveHours(11)).to.eql(11);
    expect(toTwelveHours(12)).to.eql(12);
    expect(toTwelveHours(13)).to.eql(1);
    expect(toTwelveHours(14)).to.eql(2);
    expect(toTwelveHours(15)).to.eql(3);
    expect(toTwelveHours(16)).to.eql(4);
    expect(toTwelveHours(17)).to.eql(5);
    expect(toTwelveHours(18)).to.eql(6);
    expect(toTwelveHours(19)).to.eql(7);
    expect(toTwelveHours(20)).to.eql(8);
    expect(toTwelveHours(21)).to.eql(9);
    expect(toTwelveHours(22)).to.eql(10);
    expect(toTwelveHours(23)).to.eql(11);
  });
});

describe('coerceHours', () => {
  it('should provide the correct output', () => {
    expect(coerceToTwelveHours(0)).to.eql({ hours: 12, isAm: true });
    expect(coerceToTwelveHours(1)).to.eql(null);
    expect(coerceToTwelveHours(2)).to.eql(null);
    expect(coerceToTwelveHours(3)).to.eql(null);
    expect(coerceToTwelveHours(4)).to.eql(null);
    expect(coerceToTwelveHours(5)).to.eql(null);
    expect(coerceToTwelveHours(6)).to.eql(null);
    expect(coerceToTwelveHours(7)).to.eql(null);
    expect(coerceToTwelveHours(8)).to.eql(null);
    expect(coerceToTwelveHours(9)).to.eql(null);
    expect(coerceToTwelveHours(10)).to.eql(null);
    expect(coerceToTwelveHours(11)).to.eql(null);
    expect(coerceToTwelveHours(12)).to.eql(null);
    expect(coerceToTwelveHours(13)).to.eql({ hours: 1, isAm: false });
    expect(coerceToTwelveHours(14)).to.eql({ hours: 2, isAm: false });
    expect(coerceToTwelveHours(15)).to.eql({ hours: 3, isAm: false });
    expect(coerceToTwelveHours(16)).to.eql({ hours: 4, isAm: false });
    expect(coerceToTwelveHours(17)).to.eql({ hours: 5, isAm: false });
    expect(coerceToTwelveHours(18)).to.eql({ hours: 6, isAm: false });
    expect(coerceToTwelveHours(19)).to.eql({ hours: 7, isAm: false });
    expect(coerceToTwelveHours(20)).to.eql({ hours: 8, isAm: false });
    expect(coerceToTwelveHours(21)).to.eql({ hours: 9, isAm: false });
    expect(coerceToTwelveHours(22)).to.eql({ hours: 10, isAm: false });
    expect(coerceToTwelveHours(23)).to.eql({ hours: 11, isAm: false });
  });
});

describe('rangeLimit', () => {
  let consoleWarn: typeof console.warn;
  beforeAll(() => {
    consoleWarn = console.warn;
    console.warn = () => undefined;
  });
  afterAll(() => {
    console.warn = consoleWarn;
  });

  it('should limit ranges correctly', () => {
    expect(rangeLimit(0, 1, 2)).to.eql(1);
    expect(rangeLimit(1, 1, 2)).to.eql(1);
    expect(rangeLimit(2, 1, 2)).to.eql(2);
    expect(rangeLimit(3, 1, 2)).to.eql(2);
  });
});
